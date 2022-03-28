<?php

namespace ZoteroApi;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\ResponseInterface;
use ZoteroApi\Endpoint\AbstractEndpoint;
use ZoteroApi\Exceptions\ZoteroAccessDeniedException;
use ZoteroApi\Exceptions\ZoteroBadRequestException;
use ZoteroApi\Exceptions\ZoteroConnectionException;
use ZoteroApi\Exceptions\ZoteroEndpointNotFoundException;
use ZoteroApi\Exceptions\ZoteroInvalidChainingException;
use ZoteroApi\Source\AbstractSource;

class ZoteroApi
{

    /**
     * URL Link used for all requests
     */
    public const API_ENDPOINT = "https://api.zotero.org";

    /**
     * API Key to authenticate request
     *
     * @var string
     */
    private string $apiKey;

    /**
     * Version of Zotero's API
     *
     * @var string
     */
    private string $version = "3";

    /**
     * Request's timeout
     *
     * @var int
     */
    private int $timeout = 0;

    /**
     * Source of data
     *
     * @var AbstractSource
     */
    private AbstractSource $source;

    /**
     * Endpoint
     *
     * @var AbstractEndpoint
     */
    private AbstractEndpoint $endpoint;

    private ResponseInterface $response;

    /**
     * HTTP Client
     *
     * @var Client
     */
    private ClientInterface $client;

    public function __construct(string $apiKey, AbstractSource $source)
    {
        $this->apiKey = $apiKey;
        $this->source = $source;

        $this->client = new Client([
            'base_url' => self::API_ENDPOINT
        ]);
    }

    /**
     * Sets HTTP client
     *
     * @param ClientInterface $client
     * @return $this
     */
    public function setClient(ClientInterface $client): self
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Returns API's version
     *
     * @return int
     */
    public function getVersion(): int
    {
        return $this->version;
    }

    /**
     * Sets endpoint to link
     * @param AbstractEndpoint $endpoint
     * @return $this self-reference for chaining
     * @throws ZoteroInvalidChainingException
     */
    public function setEndpoint(AbstractEndpoint $endpoint): self
    {
        if (!$this->source->canBeUsedWith($endpoint)) {
            throw new ZoteroInvalidChainingException(
                sprintf("Unable to chain endpoint %s with source %s", $endpoint::class, $this->source::class)
            );
        }
        $this->endpoint = $endpoint;

        return $this;
    }

    /**
     * Runs request with selected options
     *
     * @throws ZoteroBadRequestException Unable to perform request (general exception)
     * @throws ZoteroEndpointNotFoundException Endpoint doesn't exists
     * @throws ZoteroConnectionException Unable to connect to Zotero Zotero endpoint
     * @throws ZoteroAccessDeniedException Access denied / Invalid API key
     */
    public function run(): self
    {
        try {
            $this->response = $this->client->get(
                ((string)$this),
                [
                    "timeout" => $this->timeout,
                    "headers" => [
                        "Authorization" => "Bearer " . $this->apiKey,
                        "Zotero-API-Version" => $this->version
                    ]
                ]
            );
        } catch (ClientExceptionInterface $e) {
            $msg = sprintf("ZoteroAPI error: %s",$e->getMessage());
            $code = $e->getCode();
            throw match ($code) {
                0 => new ZoteroConnectionException($msg, $code),
                403 => new ZoteroAccessDeniedException($msg, $code),
                404 => new ZoteroEndpointNotFoundException($msg, $code),
                default => new ZoteroBadRequestException($msg, $code),
            };
        }catch (\Exception $e){
            throw new ZoteroBadRequestException(sprintf("ZoteroAPI error: %s",$e->getMessage(),$e->getCode()));
        }

        return $this;
    }

    /**
     * Returns headers of response
     *
     * @return array
     * @throws ZoteroBadRequestException
     */
    public function getHeaders(): array
    {
        if (!isset($this->response)) {
            throw new ZoteroBadRequestException();
        }

        return $this->response->getHeaders();
    }

    /**
     * Returns body of response
     *
     * @return array
     * @throws ZoteroBadRequestException
     */
    public function getBody(): array
    {
        if (!isset($this->response)) {
            throw new ZoteroBadRequestException("Response doesn't exist.");
        }

        return json_decode($this->response->getBody(),true);
    }

    /**
     * Turns its contents into URL link
     * @return string
     */
    public function __toString(): string
    {
        $url = self::API_ENDPOINT;

        // Source
        $url .= $this->source;

        // Endpoint
        if(isset($this->endpoint)){
            $url .= $this->endpoint->getURLPath();
        }

        return $url;
    }


}