<?php

use Authentication\Client;
use Dimension\Dimension;
use Filter\DimensionFilter;
use Query\QueryBuilder;

require_once __DIR__ . '../vendor/autoload.php';

class Analytics
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function get(): AnalyticsResponse
    {
        $queryBuilder = new QueryBuilder();

        $dateDimension = new Dimension("ga:date");

        $filter = new DimensionFilter("ga:dimension1", DimensionFilter::EQUAL, "2");

        $segment = new \Segment\SessionSegment();
        $segment->addDimensionFilter($filter);

        $queryBuilder
            ->addDimension($dateDimension)
            ->addDimensionFilter($filter)
            ->addSegment($segment)
            ->getQuery();
    }
}
