<?php


namespace sherin\google\analytics\Order;

use Doctrine\Common\Collections\ArrayCollection;

class OrderCollection
{
    private $orders;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
    }

    public function addOrder(Order $metric)
    {
        $this->orders->add($metric);
    }

    /**
     * @return ArrayCollection
     */
    public function getOrders(): ArrayCollection
    {
        return $this->orders;
    }

    /**
     * @param ArrayCollection $orders
     */
    public function setOrders(ArrayCollection $orders)
    {
        $this->orders = $orders;
    }
}
