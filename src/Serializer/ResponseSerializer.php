<?php


namespace sherin\google\analytics\Serializer;

use Doctrine\Common\Collections\ArrayCollection;
use Google_Service_AnalyticsReporting_Report;
use sherin\google\analytics\Dimension\Dimension;
use sherin\google\analytics\Metric\MetricCollection;
use sherin\google\analytics\Response\Analytic;
use sherin\google\analytics\Response\Response;
use DateTime;

class ResponseSerializer
{
    public static function serialize(array $responses): ArrayCollection
    {
        $batchResults = new ArrayCollection();
        /**
         * @var Google_Service_AnalyticsReporting_Report $response
         */
        foreach ($responses as $response) {
            $header = $response->getColumnHeader();
            $dimensionHeaders = $header->getDimensions();
            $metricHeaders = $header->getMetricHeader()->getMetricHeaderEntries();
            $rows = $response->getData()->getRows();

            $analyticsCollection = new Response();
            foreach ($rows as $row) {
                $dimensions = $row->getDimensions();
                $metrics = $row->getMetrics();

                $dimensionCollection = new ArrayCollection();
                $metricCollection = new ArrayCollection();

                if (!is_null($dimensions) && !is_null($dimensionHeaders)) {
                    for ($i = 0; $i < count($dimensionHeaders) && $i < count($dimensions); $i++) {
                        switch($dimensionHeaders[$i]) {
                            case "ga:date":
                                $dimensionCollection->set($dimensionHeaders[$i], self::serializeGoogleDate($dimensions[$i])->format(DateTime::ATOM));
                                break;
                            default:
                                $dimensionCollection->set($dimensionHeaders[$i], $dimensions[$i]);

                        }

                    }
                }

                foreach ($metrics as $metric) {
                    $metricValues = $metric->getValues();
                    foreach ($metricValues as $metricName => $metricData) {
                        $metricHeader = $metricHeaders[$metricName];
                        $metricCollection->set($metricHeader->getName(), $metricValues[$metricName]);
                    }
                }

                $analytic = new Analytic($dimensionCollection, $metricCollection);
                $analytic->setDimensions($dimensionCollection);
                $analytic->setMetrics($metricCollection);
                $analyticsCollection->addAnalytic($analytic);
            }
            $batchResults->add($analyticsCollection);
        }
        return $batchResults;
    }

    private static function serializeGoogleDate(string $googleDate): DateTime
    {
        $year = substr($googleDate, 0, 4);
        $month = substr($googleDate, 4, 2);
        $day = substr($googleDate, 6, 2);
        return new DateTime("{$year}/{$month}/{$day}");
    }
}
