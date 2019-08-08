<?php


namespace sherin\google\analytics\Filter;

use Doctrine\Common\Collections\ArrayCollection;

class MetricFilterCollection
{
    const AND = "AND";
    const OR = "OR";

    private $filters;
    private $operator;

    public function __construct()
    {
        $this->filters = new ArrayCollection();
        $this->operator = self:: AND;
    }

    public function __clone()
    {
        $this->filters = clone($this->filters);
    }

    public function addFilter(MetricFilter $filter)
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
     * @return string
     */
    public function getOperator(): string
    {
        return $this->operator;
    }

    /**
     * @param string $operator
     */
    public function setOperator(string $operator)
    {
        $this->operator = $operator;
    }
}
