<?php

namespace Metric;

class Metric
{
    private $name;
    private $metric;

    /**
     * Metric constructor.
     * @param $metric
     */
    public function __construct($metric)
    {
        $this->name = $metric;
        $this->metric = $metric;
    }

    /**
     * @return mixed
     */
    public function getMetric()
    {
        return $this->metric;
    }

    /**
     * @param mixed $metric
     */
    public function setMetric($metric)
    {
        $this->metric = $metric;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}
