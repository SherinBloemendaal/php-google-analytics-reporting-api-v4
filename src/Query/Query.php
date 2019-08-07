<?php


namespace sherin\google\analytics\Query;

use Google_Service_AnalyticsReporting_ReportRequest;

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

    public function exec()
    {
        if (!$this->googleQuery) {
            throw new \Exception("No valid query provided.", 500);
        }
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
