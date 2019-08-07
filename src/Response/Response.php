<?php

namespace sherin\google\analytics\Response;

use Doctrine\Common\Collections\ArrayCollection;

class Response
{
    private $analytics;

    /**
     * Response constructor.
     */
    public function __construct()
    {
        $this->analytics = new ArrayCollection();
    }

    public function addAnalytic(Analytic $analytics)
    {
        $this->analytics->add($analytics);
    }

    /**
     * @return ArrayCollection
     */
    public function getAnalytic(): ArrayCollection
    {
        return $this->analytics;
    }

    /**
     * @param ArrayCollection $analytics
     */
    public function setAnalytic(ArrayCollection $analytics)
    {
        $this->analytics = $analytics;
    }
}
