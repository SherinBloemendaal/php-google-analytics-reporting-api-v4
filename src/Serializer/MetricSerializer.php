<?php


namespace sherin\google\analytics\Serializer;

use sherin\google\analytics\Metric\MetricCollection;

class MetricSerializer
{
    /**
     * @param MetricCollection $metricCollection
     * @return array
     */
    public static function deserialize(MetricCollection $metricCollection): array
    {
        $metrics = $metricCollection->getMetrics()->toArray();
        $googleMetrics = [];
        foreach ($metrics as $metric) {
            $googleMetric = new \Google_Service_AnalyticsReporting_Metric();
            $googleMetric->setAlias($metric->getName());
            $googleMetric->setExpression($metric->getMetric());
            $googleMetrics[] = $googleMetric;
        }
        return $googleMetrics;
    }
}
