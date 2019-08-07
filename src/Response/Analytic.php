<?php


namespace sherin\google\analytics\Response;

class Analytic
{
    private $dimensions;
    private $metrics;

    /**
     * Analytic constructor.
     * @param $dimensions
     * @param $metrics
     */
    public function __construct($dimensions = null, $metrics = null)
    {
        $this->dimensions = $dimensions;
        $this->metrics = $metrics;
    }

    /**
     * @return mixed
     */
    public function getDimensions()
    {
        return $this->dimensions;
    }

    /**
     * @param mixed $dimensions
     */
    public function setDimensions($dimensions)
    {
        $this->dimensions = $dimensions;
    }

    /**
     * @return mixed
     */
    public function getMetrics()
    {
        return $this->metrics;
    }

    /**
     * @param mixed $metrics
     */
    public function setMetrics($metrics)
    {
        $this->metrics = $metrics;
    }
}
