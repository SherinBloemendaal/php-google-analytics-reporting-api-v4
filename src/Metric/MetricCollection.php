<?php


namespace sherin\google\analytics\Metric;

use Doctrine\Common\Collections\ArrayCollection;

class MetricCollection
{
    private $metrics;

    public function __construct()
    {
        $this->metrics = new ArrayCollection();
    }

    public function addMetric(Metric $metric)
    {
        $this->metrics->add($metric);
    }

    /**
     * @return ArrayCollection
     */
    public function getMetrics(): ArrayCollection
    {
        return $this->metrics;
    }

    /**
     * @param ArrayCollection $metrics
     */
    public function setMetrics(ArrayCollection $metrics)
    {
        $this->metrics = $metrics;
    }
}
