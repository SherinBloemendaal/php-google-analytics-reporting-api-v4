<?php


namespace Serializer;

use Metric\Metric;
use Metric\MetricCollection;

class MetricSerializer
{
    /**
     * @param MetricCollection $metricCollection
     * @return array
     */
    public static function serialize(MetricCollection $metricCollection): array
    {
        return $metricCollection->getMetrics()->forAll(function ($key, Metric $metric) {
            $googleMetric = new \Google_Service_AnalyticsReporting_Metric();
            $googleMetric->setAlias($metric->getName());
            $googleMetric->setExpression($metric->getMetric());
            return $googleMetric;
        });
    }
}
