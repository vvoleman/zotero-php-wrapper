<?php

namespace ZoteroApi\Endpoint;

use ZoteroApi\Core\AbstractURLPart;
use ZoteroApi\Exceptions\ZoteroInvalidChainingException;

abstract class AbstractEndpoint extends AbstractURLPart
{

    public const ALL = "";
    public const TOP = "top";
    public const TRASH = "trash";

    protected AbstractEndpoint $endpoint;

    public function __construct(string $parameter) {
        parent::__construct($parameter);
    }

    /**
     * Returns URL name of endpoint
     *
     * @return string
     */
    public abstract function getURLName(): string;

    /**
     * @return string
     */
    public function getURLPath(): string{
        $str = (string)$this;

        if(isset($this->endpoint)){
            $str .= $this->endpoint->getURLPath();
        }

        return $str;
    }

    /**
     * Adds endpoint to another endpoint
     *
     * @param AbstractEndpoint $endpoint
     * @return self
     * @throws ZoteroInvalidChainingException Endpoint not supported in current endpoint
     */
    public function setEndpoint(AbstractEndpoint $endpoint): self
    {
        if(!$this->checkEndpoint($endpoint)){
            throw new ZoteroInvalidChainingException(sprintf("Unable to add %s to endpoint",$endpoint::class));
        }

        $this->endpoint = $endpoint;

        return $this;
    }

    /**
     * Checks if endpoint can be added to current endpoint
     *
     * @param AbstractEndpoint $endpoint
     * @return bool
     */
    protected abstract function checkEndpoint(AbstractEndpoint $endpoint): bool;
}