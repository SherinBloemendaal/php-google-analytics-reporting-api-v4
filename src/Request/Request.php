<?php

namespace sherin\google\analytics\Request;

use Google_Service_AnalyticsReporting_GetReportsRequest;
use sherin\google\analytics\Analytics;
use sherin\google\analytics\Query\Query;

class Request
{
    private $query;
    private $analytics;

    /**
     * Request constructor.
     * @param Analytics $analytics
     * @param Query $query
     */
    public function __construct(Analytics $analytics, Query $query)
    {
        $this->query = $query;
        $this->analytics = $analytics;
    }

    public function send()
    {
        $request = new Google_Service_AnalyticsReporting_GetReportsRequest();
        //Again, they have set wrong @param annotation
        /* @phan-suppress-next-line PhanTypeMismatchArgument */
        $request->setReportRequests([$this->query->getGoogleQuery()]);
        return $this->analytics->getAnalyticsReporting()->reports->batchGet($request);
    }

    /**
     * @param Query $query
     * @return Request
     */
    public function setQuery(Query $query): self
    {
        $this->query = $query;
        return $this;
    }

    /**
     * @return Query
     */
    public function getQuery(): Query
    {
        return $this->query;
    }
}
