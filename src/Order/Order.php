<?php

namespace sherin\google\analytics\Order;

class Order
{
    private $name;
    private $orderBy;
    private $direction;

    /**
     * Order constructor.
     * @param $name
     * @param $orderBy
     * @param $direction
     */
    public function __construct($name, $orderBy, $direction)
    {
        $this->name = $name;
        $this->orderBy = $orderBy;
        $this->direction = $direction;
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
    public function getOrderBy()
    {
        return $this->orderBy;
    }

    /**
     * @param mixed $orderBy
     */
    public function setOrderBy($orderBy)
    {
        $this->orderBy = $orderBy;
    }

    /**
     * @return mixed
     */
    public function getDirection()
    {
        return $this->direction;
    }

    /**
     * @param mixed $direction
     */
    public function setDirection($direction)
    {
        $this->direction = $direction;
    }
}
