<?php


namespace sherin\google\analytics\Query;

use Google_Service_AnalyticsReporting_ReportRequest;
use sherin\google\analytics\Analytics;
use sherin\google\analytics\Request\Request;
use sherin\google\analytics\Response\ResponseCollection;

class Query
{
    private $googleQuery;

    /**
     * Query constructor.
     * @param Google_Service_AnalyticsReporting_ReportRequest $googleQuery
     */
    public function __construct(Google_Service_AnalyticsReporting_ReportRequest $googleQuery)
    {
        $this->googleQuery = $googleQuery;
    }

    public function exec(Analytics $analytics): ResponseCollection
    {
        if (!$this->googleQuery instanceof Google_Service_AnalyticsReporting_ReportRequest) {
            throw new \Exception("No valid query provided.", 500);
        }

        $request = new Request($analytics, $this);
        return $request->send();
    }

    /**
     * @return Google_Service_AnalyticsReporting_ReportRequest
     */
    public function getGoogleQuery(): Google_Service_AnalyticsReporting_ReportRequest
    {
        return $this->googleQuery;
    }

    /**
     * @param Google_Service_AnalyticsReporting_ReportRequest $googleQuery
     */
    public function setGoogleQuery(Google_Service_AnalyticsReporting_ReportRequest $googleQuery)
    {
        $this->googleQuery = $googleQuery;
    }
}
