<?php


namespace Filter;

use Doctrine\Common\Collections\ArrayCollection;

class DimensionFilterCollection
{
    const AND = "AND";
    const OR = "OR";

    private $filters;
    private $operator;

    public function __construct(ArrayCollection $filters = null)
    {
        $this->filters = $filters;
        $this->operator = self:: AND;
    }

    public function addFilter(DimensionFilter $filter)
    {
        $this->filters->add($filter);
    }

    /**
     * @return ArrayCollection
     */
    public function getFilters(): ArrayCollection
    {
        return $this->filters;
    }

    /**
     * @param ArrayCollection $filters
     */
    public function setFilters(ArrayCollection $filters)
    {
        $this->filters = $filters;
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
