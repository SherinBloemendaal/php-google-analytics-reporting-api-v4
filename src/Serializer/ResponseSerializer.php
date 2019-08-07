<?php


namespace sherin\google\analytics\Serializer;

use Google_Service_AnalyticsReporting_Report;
use sherin\google\analytics\Response\Response;

class ResponseSerializer
{
    public static function serialize(array $responses)
    {
        $parsedResponses = [];
        /**
         * @var Google_Service_AnalyticsReporting_Report $response
         */
        foreach ($responses as $response) {
            $header = $response->getColumnHeader();
            $dimensionHeaders = $header->getDimensions();
            $metricHeaders = $header->getMetricHeader()->getMetricHeaderEntries();
            $rows = $response->getData()->getRows();

            $dimensionsMetrics = [];
            foreach ($rows as $row) {
                $dimensions = $row->getDimensions();
                $metrics = $row->getMetrics();

                $dimensionMetric = [];
                if (!is_null($dimensions) && !is_null($dimensionHeaders)) {
                    for ($i = 0; $i < count($dimensionHeaders) && $i < count($dimensions); $i++) {
                        $dimensionMetric["dimensions"][] = [
                            "name" => $dimensionHeaders[$i],
                            "data" => $dimensions[$i]
                        ];
                    }
                }

                foreach ($metrics as $metric) {
                    $values = $metric->getValues();
                    foreach ($values as $key => $value) {
                        $entry = $metricHeaders[$key];
                        //KEY VALUE
                        $dimensionMetric["metrics"][$entry->getName()] = $values[$key];
                        //NOT KEY VALUE
//                        $dimensionMetric["metrics"][] = [
//                            "name" => $entry->getName(),
//                            "data" => $values[$key]
//                        ];
                    }
                }
                if (!empty($dimensionMetric)) {
                    $dimensionsMetrics[] = $dimensionMetric;
                }
            }
            $parsedResponses[] = $dimensionsMetrics;
        }
        return $parsedResponses;
    }
}
