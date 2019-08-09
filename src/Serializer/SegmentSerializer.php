<?php


namespace sherin\google\analytics\Serializer;

use Google_Service_AnalyticsReporting_DynamicSegment;
use Google_Service_AnalyticsReporting_OrFiltersForSegment;
use Google_Service_AnalyticsReporting_Segment;
use Google_Service_AnalyticsReporting_SegmentDefinition;
use Google_Service_AnalyticsReporting_SegmentFilter;
use Google_Service_AnalyticsReporting_SimpleSegment;
use sherin\google\analytics\Segment\SegmentCollection;
use sherin\google\analytics\Segment\SessionSegment;
use sherin\google\analytics\Segment\UserSegment;

class SegmentSerializer
{
    public static function deserialize(SegmentCollection $segmentCollection)
    {
        $segments = $segmentCollection->getSegments()->toArray();
        $googleSegments = [];
        /** @var SessionSegment|UserSegment $segment */
        foreach ($segments as $segment) {
            $dimensionFilterCollection = $segment->getDimensionFilters();
            $dimensionFilters = $dimensionFilterCollection->getFilters()->toArray();
            $metricFilters = $segment->getMetricsFilters()->getFilters()->toArray();

            $orFilters = [];
            $filterClauses = [];
            foreach ($dimensionFilters as $dimensionFilter) {
                $googleDimensionFilter = new \Google_Service_AnalyticsReporting_SegmentDimensionFilter();
                $googleDimensionFilter->setDimensionName($dimensionFilter->getKey());
                $googleDimensionFilter->setOperator(static::convertToSegmentOperator($dimensionFilter->getOperator()));
                $googleDimensionFilter->setExpressions([(string)$dimensionFilter->getValue()]);

                $segmentFilterClause = new \Google_Service_AnalyticsReporting_SegmentFilterClause();
                $segmentFilterClause->setDimensionFilter($googleDimensionFilter);

                if ($dimensionFilter->getOperator()[0] === "!") {
                    $segmentFilterClause->setNot(true);
                }

                if ($dimensionFilterCollection->getOperator() === SegmentCollection::AND) {
                    $orFiltersForSegment = new Google_Service_AnalyticsReporting_OrFiltersForSegment();
                    // Suppress because wrong @param in the Google api
                    /* @phan-suppress-next-line PhanTypeMismatchArgument */
                    $orFiltersForSegment->setSegmentFilterClauses([$segmentFilterClause]);

                    $orFilters[] = $orFiltersForSegment;
                }

                if ($dimensionFilterCollection->getOperator() === SegmentCollection::OR) {
                    $filterClauses[] = $segmentFilterClause;
                }
            }

            if ($segmentCollection->getOperator() === SegmentCollection::OR) {
                $orFiltersForSegment = new Google_Service_AnalyticsReporting_OrFiltersForSegment();
                // Suppress because wrong @param in the Google api
                /* @phan-suppress-next-line PhanTypeMismatchArgument */
                $orFiltersForSegment->setSegmentFilterClauses($filterClauses);

                // Create the Simple Segment.
                $simpleSegment = new Google_Service_AnalyticsReporting_SimpleSegment();
                // Suppress because wrong @param in the Google api
                /* @phan-suppress-next-line PhanTypeMismatchArgument */
                $simpleSegment->setOrFiltersForSegment([$orFiltersForSegment]);
            } else {
                // Create the Simple Segment.
                $simpleSegment = new Google_Service_AnalyticsReporting_SimpleSegment();
                // Suppress because wrong @param in the Google api
                /* @phan-suppress-next-line PhanTypeMismatchArgument */
                $simpleSegment->setOrFiltersForSegment($orFilters);
            }

            // Create the Segment Filters.
            $segmentFilter = new Google_Service_AnalyticsReporting_SegmentFilter();

            $segmentFilter->setSimpleSegment($simpleSegment);

            // Create the Segment Definition.
            $segmentDefinition = new Google_Service_AnalyticsReporting_SegmentDefinition();
            // Suppress because wrong @param in the Google api
            /* @phan-suppress-next-line PhanTypeMismatchArgument */
            $segmentDefinition->setSegmentFilters([$segmentFilter]);

            // Create the Dynamic Segment.
            $dynamicSegment = new Google_Service_AnalyticsReporting_DynamicSegment();

            if ($segment instanceof SessionSegment) {
                $dynamicSegment->setSessionSegment($segmentDefinition);
                $dynamicSegment->setName("sessions");
            }

            if ($segment instanceof UserSegment) {
                $dynamicSegment->setUserSegment($segmentDefinition);
                $dynamicSegment->setName("users");
            }

            // Create the Segments object.
            $segment = new Google_Service_AnalyticsReporting_Segment();
            $segment->setDynamicSegment($dynamicSegment);

            $googleSegments[] = $segment;
        }
        return $googleSegments;
    }

    private static function convertToSegmentOperator($operator)
    {
        $conversion = [
            "==" => "EXACT",
            "!=" => "EXACT",
            "<>" => "NUMERIC_BETWEEN",
            "<" => "NUMERIC_LESS_THAN",
            ">" => "NUMERIC_GREATER_THAN",
            "[]" => "IN_LIST",
            "=@" => "PARTIAL",
            "=~" => "REGEXP",
            "" => "OPERATOR_UNSPECIFIED",
        ];
        if (!array_key_exists($operator, $conversion)) {
            throw new \Exception("Impossible filter for segment. Used {$operator} but this is not supported by google.");
        }
        return $conversion[$operator];
    }
}
