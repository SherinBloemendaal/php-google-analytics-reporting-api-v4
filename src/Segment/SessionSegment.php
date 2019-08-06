<?php


namespace Segment;

use Filter\DimensionFilter;
use Filter\DimensionFilterCollection;
use Filter\MetricFilter;
use Filter\MetricFilterCollection;

class SessionSegment
{
    private $dimensionFilters;
    private $metricsFilters;

    /**
     * SessionSegment constructor.
     */
    public function __construct()
    {
        $this->dimensionFilters = new DimensionFilterCollection();
        $this->metricsFilters = new MetricFilterCollection();
    }

    public function addDimensionFilter(DimensionFilter $dimensionFilter)
    {
        $this->dimensionFilters->addFilter($dimensionFilter);
    }

    /**
     * @return DimensionFilterCollection
     */
    public function getDimensionFilters(): DimensionFilterCollection
    {
        return $this->dimensionFilters;
    }

    /**
     * @param DimensionFilterCollection $dimensionFilters
     */
    public function setDimensionFilters(DimensionFilterCollection $dimensionFilters)
    {
        $this->dimensionFilters = $dimensionFilters;
    }

    public function addMetricFilter(MetricFilter $metricFilter)
    {
        $this->metricsFilters->addFilter($metricFilter);
    }

    /**
     * @return MetricFilterCollection
     */
    public function getMetricsFilters(): MetricFilterCollection
    {
        return $this->metricsFilters;
    }

    /**
     * @param MetricFilterCollection $metricsFilters
     */
    public function setMetricsFilters(MetricFilterCollection $metricsFilters)
    {
        $this->metricsFilters = $metricsFilters;
    }
}
