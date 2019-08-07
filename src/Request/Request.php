<?php

namespace sherin\google\analytics\Request;

use Google_Service_AnalyticsReporting_GetReportsRequest;
use sherin\google\analytics\Analytics;
use sherin\google\analytics\Query\Query;
use sherin\google\analytics\Response\Response;
use sherin\google\analytics\Serializer\ResponseSerializer;

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

    public function send(): Response
    {
        $request = new Google_Service_AnalyticsReporting_GetReportsRequest();
        //Again, they have set wrong @param annotation
        /* @phan-suppress-next-line PhanTypeMismatchArgument */
        $request->setReportRequests([$this->query->getGoogleQuery()]);
        $response = $this->analytics->getAnalyticsReporting()->reports->batchGet($request);
        return ResponseSerializer::serialize($response->getReports());
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
