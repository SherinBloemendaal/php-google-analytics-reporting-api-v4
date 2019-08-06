<?php

namespace sherin\google\analytics;

use sherin\google\analytics\Authentication\Client;

require_once __DIR__ . '../vendor/autoload.php';

class Analytics
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }
}
