<?php

namespace sherin\google\analytics;

use Google_Service_AnalyticsReporting;
use sherin\google\analytics\Authentication\Client;

class Analytics
{
    private $client;
    private $analyticsReporting;

    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->analyticsReporting = new Google_Service_AnalyticsReporting($client->getGoogleClient());
    }

    /**
     * @return Google_Service_AnalyticsReporting
     */
    public function getAnalyticsReporting(): Google_Service_AnalyticsReporting
    {
        return $this->analyticsReporting;
    }

    /**
     * @param Google_Service_AnalyticsReporting $analyticsReporting
     */
    public function setAnalyticsReporting(Google_Service_AnalyticsReporting $analyticsReporting)
    {
        $this->analyticsReporting = $analyticsReporting;
    }
}
