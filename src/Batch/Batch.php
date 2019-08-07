<?php

use Doctrine\Common\Collections\ArrayCollection;

class Batch
{
    private $requests;

    /**
     * Batch constructor.
     */
    public function __construct()
    {
        $this->requests = new ArrayCollection();
    }

    public function addRequest($request)
    {
        $this->requests->add($request);
    }

    /**
     * @return ArrayCollection
     */
    public function getRequests(): ArrayCollection
    {
        return $this->requests;
    }

    /**
     * @param ArrayCollection $requests
     */
    public function setRequests(ArrayCollection $requests)
    {
        $this->requests = $requests;
    }


}