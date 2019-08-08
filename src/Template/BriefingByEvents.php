<?php
namespace sherin\google\analytics\Template;

use sherin\google\analytics\Dimension\Dimension;
use sherin\google\analytics\Metric\Metric;
use sherin\google\analytics\Order\Order;
use sherin\google\analytics\Order\OrderBy;
use sherin\google\analytics\Query\Direction;
use sherin\google\analytics\Query\QueryBuilder;

class BriefingByEvents
{
    public static function getQueryBuilder(): QueryBuilder
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder
            ->addDimension(new Dimension("ga:eventCategory"))
            ->addDimension(new Dimension("ga:eventAction"))
            ->addDimension(new Dimension("ga:eventLabel"))
            ->addMetric(new Metric("ga:users"))
            ->addMetric(new Metric("ga:totalEvents"))
            ->addMetric(new Metric("ga:uniqueEvents"))
            ->addOrderBy(new Order("ga:totalEvents", OrderBy::VALUE, Direction::DESCENDING))
            ->setMaxResults(10);
        ;
        return $queryBuilder;
    }
}
