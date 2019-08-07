<?php


namespace sherin\google\analytics\Serializer;

use sherin\google\analytics\Filter\MetricFilterCollection;

class MetricFilterSerializer
{
    public static function serialize(MetricFilterCollection $filterCollection)
    {
        $metricFilterClause = new \Google_Service_AnalyticsReporting_MetricFilterClause();
        $filters = $filterCollection->getFilters()->toArray();

        $googleFilters = [];

        foreach ($filters as $filter) {
            $googleFilter = new \Google_Service_AnalyticsReporting_MetricFilter();
            $googleFilter->setMetricName($filter->getKey());
            $googleFilter->setOperator($filter->getOperator());
            $googleFilter->setComparisonValue($filter->getValue());
            $googleFilters[] = $googleFilter;
        }

        // Suppress because wrong @param in the Google api
        /* @phan-suppress-next-line PhanTypeMismatchArgument */
        $metricFilterClause->setFilters($googleFilters);
        $metricFilterClause->setOperator($filterCollection->getOperator());
        return $metricFilterClause;
    }
}
