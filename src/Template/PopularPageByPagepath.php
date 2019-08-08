<?php


use sherin\google\analytics\Dimension\Dimension;
use sherin\google\analytics\Metric\Metric;
use sherin\google\analytics\Order\Order;
use sherin\google\analytics\Order\OrderBy;
use sherin\google\analytics\Query\Direction;
use sherin\google\analytics\Query\QueryBuilder;

class PopularPageByPagepath
{
    public static function getQueryBuilder(): QueryBuilder
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder
            ->addDimension(new Dimension("ga:pagePathLevel3"))
            ->addMetric(new Metric("ga:uniquePageViews"))
            ->addMetric(new Metric("ga:bounceRate"))
            ->addMetric(new Metric("ga:pageviews"))
            ->addMetric(new Metric("ga:avgTimeOnPage"))
            ->addMetric(new Metric("ga:entrances"))
            ->addMetric(new Metric("ga:exits"))
            ->addMetric(new Metric("ga:uniqueEvents"))
            ->addOrderBy(new Order("ga:pageviews", OrderBy::VALUE, Direction::DESCENDING))
            ->setMaxResults(10);
        ;
        return $queryBuilder;
    }
}