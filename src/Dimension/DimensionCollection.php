<?php


namespace sherin\google\analytics\Dimension;

use Doctrine\Common\Collections\ArrayCollection;

class DimensionCollection
{
    private $dimensions;

    public function __construct()
    {
        $this->dimensions = new ArrayCollection();
    }
    public function __clone()
    {
        $this->dimensions = clone($this->dimensions);
    }

    public function addDimension(Dimension $dimension)
    {
        $this->dimensions->add($dimension);
    }

    /**
     * @return ArrayCollection
     */
    public function getDimensions(): ArrayCollection
    {
        return $this->dimensions;
    }

    /**
     * @param ArrayCollection $dimensions
     */
    public function setDimensions(ArrayCollection $dimensions)
    {
        $this->dimensions = $dimensions;
    }
}
