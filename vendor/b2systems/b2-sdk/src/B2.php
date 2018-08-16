<?php

namespace B2Systems\B2;

use GuzzleHttp\Client as HttpClient;
use B2Systems\B2\Actions\ManagesUsers;
use B2Systems\B2\Actions\ManagesOrganisations;
use B2Systems\B2\Actions\ManagesSchools;

class B2
{
    use MakesHttpRequests, ManagesUsers, ManagesOrganisations, ManagesSchools;

    /**
     * The B2 API Key.
     *
     * @var string
     */
    public $apiKey;

    /**
     * The Guzzle HTTP Client instance.
     *
     * @var \GuzzleHttp\Client
     */
    public $guzzle;

    /**
     * Number of seconds a request is retried.
     *
     * @var int
     */
    public $timeout = 30;

    public $baseUrl = 'http://b2systems.test/api/';

    /**
     * Create a new B2 instance.
     *
     * @param  string $apiKey
     * @param  \GuzzleHttp\Client $guzzle
     * @return void
     */
    public function __construct($apiKey, HttpClient $guzzle = null)
    {
        $this->apiKey = $apiKey;
        $this->guzzle = $guzzle ?: new HttpClient([
            'base_uri' => $this->baseUrl,
            'headers' => [
                'Authorization' => 'Bearer '.$this->apiKey,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ]
        ]);
    }

    /**
     * Transform the items of the collection to the given class.
     *
     * @param  array $collection
     * @param  string $class
     * @param  array $extraData
     * @return array
     */
    public function transformCollection($collection, $class, $extraData = [], $relations = [])
    {
        return array_map(function ($data) use ($class, $extraData, $relations) {
            return new $class($data, $this, $relations);
        }, $collection);
    }

    /**
     * Set a new timeout
     *
     * @param  int $timeout
     * @return $this
     */
    public function setTimeout($timeout)
    {
        $this->timeout = $timeout;
        return $this;
    }
    /**
     * Get the timeout
     *
     * @return  int
     */
    public function getTimeout()
    {
        return $this->timeout;
    }
}
