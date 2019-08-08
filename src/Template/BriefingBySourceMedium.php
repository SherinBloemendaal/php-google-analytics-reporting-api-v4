<?php
namespace sherin\google\analytics\Template;

use sherin\google\analytics\Dimension\Dimension;
use sherin\google\analytics\Metric\Metric;
use sherin\google\analytics\Order\Order;
use sherin\google\analytics\Order\OrderBy;
use sherin\google\analytics\Query\Direction;
use sherin\google\analytics\Query\QueryBuilder;

class BriefingBySourceMedium
{
    public static function getQueryBuilder(QueryBuilder $queryBuilder = null): QueryBuilder
    {
        $queryBuilder = new QueryBuilder($queryBuilder);
        $queryBuilder
            ->addDimension(new Dimension("ga:sourceMedium"))
            ->addMetric(new Metric("ga:pageviews"))
            ->addMetric(new Metric("ga:sessions"))
            ->addMetric(new Metric("ga:pageviewsPerSession"))
            ->addMetric(new Metric("ga:avgTimeOnPage"))
            ->addMetric(new Metric("ga:bounceRate"))
            ->addOrderBy(new Order("ga:pageviews", OrderBy::VALUE, Direction::DESCENDING))
            ->setMaxResults(10);
        ;
        return $queryBuilder;
    }
}
