<?php

namespace vvoleman\ZoteroApi\Tests\Mock;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Promise\PromiseInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;

class MockClient implements ClientInterface
{

    public function get($uri, array $options = []): ResponseInterface{
        return new MockResponse();
    }

    /**
     * @inheritDoc
     */
    public function send(RequestInterface $request, array $options = []): ResponseInterface
    {
        // TODO: Implement send() method.
    }

    /**
     * @inheritDoc
     */
    public function sendAsync(RequestInterface $request, array $options = []): PromiseInterface
    {
        // TODO: Implement sendAsync() method.
    }

    /**
     * @inheritDoc
     */
    public function request(string $method, $uri, array $options = []): ResponseInterface
    {
        // TODO: Implement request() method.
    }

    /**
     * @inheritDoc
     */
    public function requestAsync(string $method, $uri, array $options = []): PromiseInterface
    {
        // TODO: Implement requestAsync() method.
    }

    /**
     * @inheritDoc
     */
    public function getConfig(?string $option = null)
    {
        return [];
    }
}