<?php
namespace sherin\google\analytics\Template;

use sherin\google\analytics\Dimension\Dimension;
use sherin\google\analytics\Metric\Metric;
use sherin\google\analytics\Order\Order;
use sherin\google\analytics\Order\OrderBy;
use sherin\google\analytics\Query\Direction;
use sherin\google\analytics\Query\QueryBuilder;

class SessionsByScreenResolution
{
    public static function getQueryBuilder(QueryBuilder $queryBuilder = null): QueryBuilder
    {
        $queryBuilder = new QueryBuilder($queryBuilder);
        $queryBuilder
            ->addDimension(new Dimension("ga:browserSize"))
            ->addMetric(new Metric("ga:sessions"))
            ->addOrderBy(new Order("ga:sessions", OrderBy::VALUE, Direction::DESCENDING))
            ->setMaxResults(10);
        ;
        return $queryBuilder;
    }
}
