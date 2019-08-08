<?php
namespace sherin\google\analytics\Batch;

use Doctrine\Common\Collections\ArrayCollection;
use sherin\google\analytics\Analytics;
use sherin\google\analytics\Request\Request;
use sherin\google\analytics\Response\ResponseCollection;
use sherin\google\analytics\Serializer\BatchRequestSerializer;
use sherin\google\analytics\Serializer\ResponseSerializer;

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

    public function send(): ResponseCollection
    {
        //TODO customizable chunksize
        $requestChunk = array_chunk($this->requests->toArray(), 5);

        $responses = [];
        foreach ($requestChunk as $chunk) {
            $response = $this->analytics->getAnalyticsReporting()->reports->batchGet(BatchRequestSerializer::deserialize($chunk));
            $responseDeserialized = ResponseSerializer::deserialize($response->getReports());
            /* @phan-suppress-next-line PhanTypeMismatchArgumentInternal */ //Because google returns a array
            $responses = array_merge($responses, $responseDeserialized->getResponses()->toArray());
        }
        $responseCollection = new ResponseCollection();
        $responseCollection->setResponses(new ArrayCollection($responses));
        return $responseCollection;
    }

    public function addRequest(Request $request)
    {
        $this->requests->add($request);
        return $this;
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
