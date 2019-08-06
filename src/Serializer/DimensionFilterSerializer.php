<?php


namespace Serializer;

use Filter\DimensionFilter;
use Filter\DimensionFilterCollection;

class DimensionFilterSerializer
{
    public static function serialize(DimensionFilterCollection $filterCollection)
    {
        $dimensionFilterClause = new \Google_Service_AnalyticsReporting_DimensionFilterClause();

        $filters = $filterCollection->getFilters()->toArray();

        $googleFilters = [];
        foreach ($filters as $filter) {
            $googleFilter = new \Google_Service_AnalyticsReporting_DimensionFilter();
            $googleFilter->setDimensionName($filter->getKey());
            $googleFilter->setOperator($filter->getOperator());
            $googleFilter->setExpressions($filter->getValue());
            $googleFilters[] = $googleFilter;
        }

        $dimensionFilterClause->setFilters($filters);
        $dimensionFilterClause->setOperator($filterCollection->getOperator());
        return $dimensionFilterClause;
//        $filters = $filterCollection->getFilters()->forAll(
//            function ($key, DimensionFilter $filter) {
//                $googleFilter = new \Google_Service_AnalyticsReporting_DimensionFilter();
//                $googleFilter->setDimensionName($filter->getKey());
//                $googleFilter->setOperator($filter->getOperator());
//                $googleFilter->setExpressions($filter->getValue());
//                return $googleFilter;
//            });
    }
}
