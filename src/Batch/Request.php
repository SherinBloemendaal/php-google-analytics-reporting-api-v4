<?php

namespace sherin\google\analytics\Batch;

use Google_Service_AnalyticsReporting_GetReportsRequest;
use sherin\google\analytics\Analytics;
use sherin\google\analytics\Query\QueryBuilder;

class Request
{
    private $query;
    private $analytics;

    /**
     * Request constructor.
     * @param Analytics $analytics
     * @param QueryBuilder $queryBuilder
     */
    public function __construct(Analytics $analytics, QueryBuilder $queryBuilder)
    {
        $this->query = $queryBuilder;
        $this->analytics = $analytics;
    }

    public function send()
    {
        $request = new Google_Service_AnalyticsReporting_GetReportsRequest();
        //Again, they have set wrong @param annotation
        /* @phan-suppress-next-line PhanTypeMismatchArgument */
        $request->setReportRequests([$this->query]);
        //Again, they have set wrong @param annotation
        /* @phan-suppress-next-line PhanTypeMismatchArgument */
        return $this->analytics->getAnalyticsReporting()->reports->batchGet([$request]);
    }

    /**
     * @param QueryBuilder $query
     * @return Request
     */
    public function setQuery(QueryBuilder $query): self
    {
        $this->query = $query;
        return $this;
    }

    /**
     * @return QueryBuilder
     */
    public function getQuery(): QueryBuilder
    {
        return $this->query;
    }
}
