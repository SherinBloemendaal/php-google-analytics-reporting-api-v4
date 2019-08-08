<?php

namespace sherin\google\analytics\Template;

use sherin\google\analytics\Dimension\Dimension;
use sherin\google\analytics\Metric\Metric;
use sherin\google\analytics\Query\QueryBuilder;

class Briefing
{
    public static function getQueryBuilder(): QueryBuilder
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder
            ->addMetric(new Metric("ga:sessions"))
            ->addMetric(new Metric("ga:users"))
            ->addMetric(new Metric("ga:bounceRate"))
            ->addMetric(new Metric("ga:pageviewsPerSession"))
            ->addMetric(new Metric("ga:avgTimeOnPage"))
            ->addMetric(new Metric("ga:uniquePageviews"))
            ->addMetric(new Metric("ga:pageviews"));
        return $queryBuilder;
    }
}
