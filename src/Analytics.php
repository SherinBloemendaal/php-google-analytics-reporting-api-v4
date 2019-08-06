<?php

namespace sherin\google\analytics;

use Authentication\Client;
use Dimension\Dimension;
use Filter\DimensionFilter;
use Query\QueryBuilder;

require_once __DIR__ . '../vendor/autoload.php';

class Analytics
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }
}
