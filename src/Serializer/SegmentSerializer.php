<?php


namespace sherin\google\analytics\Serializer;

use Google_Service_AnalyticsReporting_DynamicSegment;
use Google_Service_AnalyticsReporting_OrFiltersForSegment;
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
            $dimensionFilters = $segment->getDimensionFilters()->getFilters()->toArray();
            $metricFilters = $segment->getMetricsFilters()->getFilters()->toArray();

            $googleDimensionFilters = [];
            foreach ($dimensionFilters as $dimensionFilter) {
                $googleDimensionFilter = new \Google_Service_AnalyticsReporting_SegmentDimensionFilter();
                $googleDimensionFilter->setDimensionName($dimensionFilter->getKey());
                $googleDimensionFilter->setOperator($dimensionFilter->getOperator());
                $googleDimensionFilter->setExpressions($dimensionFilter->getValue());

                $segmentFilterClause = new \Google_Service_AnalyticsReporting_SegmentFilterClause();
                $segmentFilterClause->setDimensionFilter($googleDimensionFilter);

                if ($segmentCollection->getOperator() === SegmentCollection::AND) {
                    $orFiltersForSegment = new Google_Service_AnalyticsReporting_OrFiltersForSegment();
                    // Suppress because wrong @param in the Google api
                    /* @phan-suppress-next-line PhanTypeMismatchArgument */
                    $orFiltersForSegment->setSegmentFilterClauses([$segmentFilterClause]);

                    $googleDimensionFilters[] = $orFiltersForSegment;
                }

                if ($segmentCollection->getOperator() === SegmentCollection::OR) {
                    $googleDimensionFilters[] = $segmentFilterClause;
                }
            }

            if ($segmentCollection->getOperator() === SegmentCollection::OR) {
                $orFiltersForSegment = new Google_Service_AnalyticsReporting_OrFiltersForSegment();
                // Suppress because wrong @param in the Google api
                /* @phan-suppress-next-line PhanTypeMismatchArgument */
                $orFiltersForSegment->setSegmentFilterClauses($googleDimensionFilters);
            }

            // Create the Simple Segment.
            $simpleSegment = new Google_Service_AnalyticsReporting_SimpleSegment();
            // Suppress because wrong @param in the Google api
            /* @phan-suppress-next-line PhanTypeMismatchArgument */
            $simpleSegment->setOrFiltersForSegment($googleDimensionFilters);

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
                $dynamicSegment->setName("session_segment");
            }

            if ($segment instanceof UserSegment) {
                $dynamicSegment->setUserSegment($segmentDefinition);
                $dynamicSegment->setName("user_segment");
            }
            $googleSegments[] = $dynamicSegment;
        }
        return $googleSegments;
    }
}
