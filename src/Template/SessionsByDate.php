<?php
namespace sherin\google\analytics\Template;

use sherin\google\analytics\Dimension\Dimension;
use sherin\google\analytics\Metric\Metric;
use sherin\google\analytics\Query\QueryBuilder;

class SessionsByDate
{
    public static function getQueryBuilder(): QueryBuilder
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder
            ->addDimension(new Dimension("ga:date"))
            ->addMetric(new Metric("ga:sessions"));
        return $queryBuilder;
    }
}
