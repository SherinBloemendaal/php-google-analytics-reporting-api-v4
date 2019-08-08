<?php


namespace sherin\google\analytics\Response;

use Doctrine\Common\Collections\ArrayCollection;

class ResponseCollection
{
    private $responses;

    /**
     * ResponseCollection constructor.
     */
    public function __construct()
    {
        $this->responses = new ArrayCollection();
    }

    public function addResponse(Response $response)
    {
        $this->responses->add($response);
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getResponses(): ArrayCollection
    {
        return $this->responses;
    }

    /**
     * @param ArrayCollection $responses
     */
    public function setResponses(ArrayCollection $responses)
    {
        $this->responses = $responses;
    }

    public function toArray(): array
    {
        $responsesArray = [];
        $responses = $this->responses->toArray();
        /* @var Response $response */
        foreach ($responses as $response) {
            $analyticsArray = [];
            /* @var Analytic $analytics */
            $analytics = $response->getAnalytic()->toArray();
            foreach ($analytics as $analytic) {
                $dimensions = $analytics->getDimensions();
                $metrics = $analytics->getMetrics();
                $analytic = [
                    "dimensions" => $dimensions,
                    "metrics" => $metrics
                ];
                $analyticsArray[] = $analytic;
            }
            $responsesArray[] = $analytics;
        }
    }
}
