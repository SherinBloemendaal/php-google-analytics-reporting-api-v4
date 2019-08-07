<?php
namespace sherin\google\analytics\Batch;

use Doctrine\Common\Collections\ArrayCollection;
use sherin\google\analytics\Analytics;
use sherin\google\analytics\Serializer\BatchRequestSerializer;

class Batch
{
    private $requests;
    private $analytics;

    /**
     * Batch constructor.
     * @param Analytics $analytics
     */
    public function __construct(Analytics $analytics)
    {
        $this->requests = new ArrayCollection();
        $this->analytics = $analytics;
    }

    public function send(): array
    {
        $requestChunk = array_chunk($this->requests->toArray(), 5);

        $responses = [];
        foreach ($requestChunk as $chunk) {
            $responses[] = $this->analytics->getAnalyticsReporting()->reports->batchGet(BatchRequestSerializer::serialize($chunk));
        }

        return $responses;
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
