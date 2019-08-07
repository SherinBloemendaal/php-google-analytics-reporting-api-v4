<?php


namespace sherin\google\analytics\Serializer;

use Google_Service_AnalyticsReporting_GetReportsRequest;

class BatchRequestSerializer
{
    public static function deserialize(array $requestChunk): Google_Service_AnalyticsReporting_GetReportsRequest
    {
        $queries = [];
        /**
         * @var Request $request
         */
        foreach ($requestChunk as $request) {
            $queries[] = $request->getQuery()->getGoogleQuery();
        }

        $batchQuery = new Google_Service_AnalyticsReporting_GetReportsRequest();
        //Again, they have set wrong @param annotation
        /* @phan-suppress-next-line PhanTypeMismatchArgument */
        $batchQuery->setReportRequests($queries);
        return $batchQuery;
    }
}
