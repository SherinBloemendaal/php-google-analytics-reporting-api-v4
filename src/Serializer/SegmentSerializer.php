<?php


namespace Serializer;

use Google_Service_AnalyticsReporting_DynamicSegment;
use Google_Service_AnalyticsReporting_OrFiltersForSegment;
use Google_Service_AnalyticsReporting_SegmentDefinition;
use Google_Service_AnalyticsReporting_SegmentFilter;
use Google_Service_AnalyticsReporting_SimpleSegment;
use Segment\SegmentCollection;
use Segment\SessionSegment;
use Segment\UserSegment;

class SegmentSerializer
{
    public static function serialize(SegmentCollection $segmentCollection)
    {
//        $segmentCollection->getSegments()->forAll(function ($key, $segment) {
//
//            $segmentDimensionFilters = $segment->getDimensionFilters()->getFilters()->forAll(
//                function ($key, DimensionFilter $dimensionFilter) {
//                    $googleDimensionFilter = new \Google_Service_AnalyticsReporting_SegmentDimensionFilter();
//                    $googleDimensionFilter->setDimensionName($dimensionFilter->getKey());
//                    $googleDimensionFilter->setOperator($dimensionFilter->getOperator());
//                    $googleDimensionFilter->setExpressions($dimensionFilter->getValue());
//                    return $googleDimensionFilter;
//                });
//
//            $segmentMetricFilter = $segment->getMetricsFilters()->getFilters()->forAll(
//                function ($key, MetricFilter $metricFilter) {
//                    $googleMetricFilter = new \Google_Service_AnalyticsReporting_SegmentMetricFilter();
//                    $googleMetricFilter->setMetricName($metricFilter->getKey());
//                    $googleMetricFilter->setOperator($metricFilter->getOperator());
//                    $googleMetricFilter->setComparisonValue($metricFilter->getValue());
//                    return $googleMetricFilter;
//                });
//        });

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
                $segmentFilterClause->setDimensionFilter($dimensionFilter);

                if ($segmentCollection->getOperator() === SegmentCollection::AND) {
                    $orFiltersForSegment = new Google_Service_AnalyticsReporting_OrFiltersForSegment();
                    $orFiltersForSegment->setSegmentFilterClauses([$segmentFilterClause]);

                    $googleDimensionFilters[] = $orFiltersForSegment;
                }

                if ($segmentCollection->getOperator() === SegmentCollection::OR) {
                    $googleDimensionFilters[] = $segmentFilterClause;
                }
            }

//            $googleMetricFilters = [];
//            foreach ($metricFilters as $metricFilter) {
//                $googleMetricFilter = new \Google_Service_AnalyticsReporting_SegmentMetricFilter();
//                $googleMetricFilter->setMetricName($metricFilter->getKey());
//                $googleMetricFilter->setOperator($metricFilter->getOperator());
//                $googleMetricFilter->setComparisonValue($metricFilter->getValue());
//                $googleMetricFilters[] = $googleMetricFilter;
//            }

            if ($segmentCollection->getOperator() === SegmentCollection::OR) {
                $orFiltersForSegment = new Google_Service_AnalyticsReporting_OrFiltersForSegment();
                $orFiltersForSegment->setSegmentFilterClauses($googleDimensionFilters);
            }

            // Create the Simple Segment.
            $simpleSegment = new Google_Service_AnalyticsReporting_SimpleSegment();
            $simpleSegment->setOrFiltersForSegment($googleDimensionFilters);

            // Create the Segment Filters.
            $segmentFilter = new Google_Service_AnalyticsReporting_SegmentFilter();

            $segmentFilter->setSimpleSegment($simpleSegment);

            // Create the Segment Definition.
            $segmentDefinition = new Google_Service_AnalyticsReporting_SegmentDefinition();
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
