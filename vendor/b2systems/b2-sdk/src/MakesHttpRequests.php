<?php

namespace B2Systems\B2;

use Psr\Http\Message\ResponseInterface;
use B2Systems\B2\Exceptions\TimeoutException;
use B2Systems\B2\Exceptions\NotFoundException;
use B2Systems\B2\Exceptions\ValidationException;
use B2Systems\B2\Exceptions\FailedActionException;

trait MakesHttpRequests
{
    /**
     * Make a GET request to B2 servers and return the response.
     *
     * @param  string $uri
     * @return mixed
     */
    private function get($uri, $query = [])
    {
        return $this->request('GET', $uri, [], $query);
    }

    /**
     * Make a POST request to B2 servers and return the response.
     *
     * @param  string $uri
     * @param  array $payload
     * @return mixed
     */
    private function post($uri, array $payload = [], $query = [])
    {
        return $this->request('POST', $uri, $payload, $query);
    }

    /**
     * Make a PUT request to B2 servers and return the response.
     *
     * @param  string $uri
     * @param  array $payload
     * @return mixed
     */
    private function put($uri, array $payload = [], $query = [])
    {
        return $this->request('PUT', $uri, $payload, $query);
    }

    /**
     * Make a DELETE request to B2 servers and return the response.
     *
     * @param  string $uri
     * @param  array $payload
     * @return mixed
     */
    private function delete($uri, array $payload = [], $query = [])
    {
        return $this->request('DELETE', $uri, $payload, $query);
    }

    /**
     * Make request to B2 servers and return the response.
     *
     * @param  string $verb
     * @param  string $uri
     * @param  array $payload
     * @return mixed
     */
    private function request($verb, $uri, array $payload = [], array $query = [])
    {
        $response = $this->guzzle->request($verb, $uri,
            (empty($payload) && empty($query)) ? [] : ['form_params' => $payload, 'query' => $query]
        );
        if (substr($response->getStatusCode(), 0, 2) != 20) {
            return $this->handleRequestError($response);
        }
        $responseBody = (string) $response->getBody();
        return json_decode($responseBody, true) ?: $responseBody;
    }

    /**
     * @param  \Psr\Http\Message\ResponseInterface $response
     * @return void
     */
    private function handleRequestError(ResponseInterface $response)
    {
        if ($response->getStatusCode() == 422) {
            throw new ValidationException(json_decode((string) $response->getBody(), true));
        }
        if ($response->getStatusCode() == 404) {
            throw new NotFoundException();
        }
        if ($response->getStatusCode() == 400) {
            throw new FailedActionException((string) $response->getBody());
        }
        throw new \Exception((string) $response->getBody());
    }

    /**
     * Retry the callback or fail after x seconds.
     *
     * @param  integer $timeout
     * @param  callable $callback
     * @return mixed
     */
    public function retry($timeout, $callback)
    {
        $start = time();
        beginning:
        if ($output = $callback()) {
            return $output;
        }
        if (time() - $start < $timeout) {
            sleep(5);
            goto beginning;
        }
        throw new TimeoutException($output);
    }
}
