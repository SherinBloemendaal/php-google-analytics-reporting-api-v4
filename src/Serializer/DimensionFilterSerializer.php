<?php


namespace sherin\google\analytics\Serializer;

use Google_Service_AnalyticsReporting_DimensionFilterClause;
use sherin\google\analytics\Filter\DimensionFilterCollection;

class DimensionFilterSerializer
{
    public static function deserialize(DimensionFilterCollection $filterCollection)
    {
        $dimensionFilterClause = new Google_Service_AnalyticsReporting_DimensionFilterClause();

        $filters = $filterCollection->getFilters()->toArray();

        $googleFilters = [];
        foreach ($filters as $filter) {
            $googleFilter = new \Google_Service_AnalyticsReporting_DimensionFilter();
            $googleFilter->setDimensionName($filter->getKey());
            $googleFilter->setOperator(static::convertToSegmentOperator($filter->getOperator()));
            $googleFilter->setExpressions($filter->getValue());
            $googleFilters[] = $googleFilter;
        }

        // Suppress because wrong @param in the Google api
        /* @phan-suppress-next-line PhanTypeMismatchArgument */
        $dimensionFilterClause->setFilters($googleFilters);
        $dimensionFilterClause->setOperator($filterCollection->getOperator());
        return $dimensionFilterClause;
    }

    private static function convertToSegmentOperator($operator)
    {
        $conversion = [
            "==" => "EXACT",
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
