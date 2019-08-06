<?php

namespace sherin\google\analytics\Dimension;

class Dimension
{
    private $name;
    private $dimension;

    public function __construct($dimension)
    {
        $this->name = $dimension;
        $this->dimension = $dimension;
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

    /**
     * @return mixed
     */
    public function getDimension()
    {
        return $this->dimension;
    }

    /**
     * @param mixed $dimension
     */
    public function setDimension($dimension)
    {
        $this->dimension = $dimension;
    }
}
