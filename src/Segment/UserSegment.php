<?php


namespace sherin\google\analytics\Segment;

use sherin\google\analytics\Filter\DimensionFilter;
use sherin\google\analytics\Filter\DimensionFilterCollection;
use sherin\google\analytics\Filter\MetricFilter;
use sherin\google\analytics\Filter\MetricFilterCollection;

class UserSegment
{
    private $dimensionFilters;
    private $metricsFilters;

    /**
     * UserSegment constructor.
     */
    public function __construct()
    {
        $this->dimensionFilters = new DimensionFilterCollection();
        $this->metricsFilters = new MetricFilterCollection();
    }
    
    public function __clone()
    {
        $this->dimensionFilters = clone($this->dimensionFilters);
        $this->metricsFilters = clone($this->metricsFilters);
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
