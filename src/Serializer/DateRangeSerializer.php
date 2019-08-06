<?php

namespace sherin\google\analytics\Serializer;

use DateTime;
use Google_Service_AnalyticsReporting_DateRange;

class DateRangeSerializer
{
    /**
     * @param DateTime $startDate
     * @param DateTime $endDate
     * @return Google_Service_AnalyticsReporting_DateRange
     */
    public static function serialize(DateTime $startDate, DateTime $endDate): Google_Service_AnalyticsReporting_DateRange
    {
        $dateRange = new Google_Service_AnalyticsReporting_DateRange();
        $dateRange->setStartDate($startDate->format("Y-m-d"));
        $dateRange->setEndDate($endDate->format("Y-m-d"));
        return $dateRange;
    }
}
