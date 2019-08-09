<?php


namespace sherin\google\analytics\Segment;

use Doctrine\Common\Collections\ArrayCollection;

class SegmentCollection
{
    const AND = "AND";
    const OR = "OR";

    private $operator;
    private $segments;

    public function __construct()
    {
        $this->segments = new ArrayCollection();
        $this->operator = self::AND;
    }

    public function __clone()
    {
        $this->segments = clone($this->segments) ;
    }

    public function addSegment($segment)
    {
        $this->segments->add($segment);
    }

    /**
     * @return ArrayCollection
     */
    public function getSegments(): ArrayCollection
    {
        return $this->segments;
    }

    /**
     * @param ArrayCollection $segments
     */
    public function setSegments(ArrayCollection $segments)
    {
        $this->segments = $segments;
    }

    /**
     * @return mixed
     */
    public function getOperator()
    {
        return $this->operator;
    }

    /**
     * @param mixed $operator
     */
    public function setOperator($operator)
    {
        $this->operator = $operator;
    }
}
