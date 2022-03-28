<?php

namespace vvoleman\ZoteroApi\Tests\Mock;

class MockResponse implements \Psr\Http\Message\ResponseInterface
{

    /**
     * @inheritDoc
     */
    public function getProtocolVersion()
    {
        // TODO: Implement getProtocolVersion() method.
    }

    /**
     * @inheritDoc
     */
    public function withProtocolVersion($version)
    {
        // TODO: Implement withProtocolVersion() method.
    }

    /**
     * @inheritDoc
     */
    public function getHeaders()
    {
        $str = '{"Date":["Wed, 23 Mar 2022 23:20:08 GMT"],"Server":["Apache\/2.4.52 ()"],"Strict-Transport-Security":["max-age=31536000; includeSubDomains; preload"],"Zotero-API-Version":["3"],"Zotero-Schema-Version":["15"],"Total-Results":["4"],"Link":["; rel=\"alternate\""],"Last-Modified-Version":["42"],"Vary":["Accept-Encoding"],"Content-Length":["4319"],"Content-Type":["application\/json"]}';
        return json_decode($str,true);
    }

    /**
     * @inheritDoc
     */
    public function hasHeader($name)
    {
        // TODO: Implement hasHeader() method.
    }

    /**
     * @inheritDoc
     */
    public function getHeader($name)
    {
        // TODO: Implement getHeader() method.
    }

    /**
     * @inheritDoc
     */
    public function getHeaderLine($name)
    {
        // TODO: Implement getHeaderLine() method.
    }

    /**
     * @inheritDoc
     */
    public function withHeader($name, $value)
    {
        // TODO: Implement withHeader() method.
    }

    /**
     * @inheritDoc
     */
    public function withAddedHeader($name, $value)
    {
        // TODO: Implement withAddedHeader() method.
    }

    /**
     * @inheritDoc
     */
    public function withoutHeader($name)
    {
        // TODO: Implement withoutHeader() method.
    }

    /**
     * @inheritDoc
     */
    public function getBody()
    {
        $str = '{"key":"ABCDEFG","version":42,"library":{"type":"user","id":9200014,"name":"vvoleman","links":{"alternate":{"href":"https:\/\/www.zotero.org\/vvoleman","type":"text\/html"}}},"links":{"self":{"href":"https:\/\/api.zotero.org\/users\/9200014\/collections\/HH8ENUPI","type":"application\/json"},"alternate":{"href":"https:\/\/www.zotero.org\/vvoleman\/collections\/HH8ENUPI","type":"text\/html"},"up":{"href":"https:\/\/api.zotero.org\/users\/9200014\/collections\/PRTMAH7I","type":"application\/json"}},"meta":{"numCollections":0,"numItems":0},"data":{"key":"HH8ENUPI","version":42,"name":"Nepovinn\u00e9","parentCollection":"PRTMAH7I","relations":{}}},{"key":"UN67Z6ZP","version":35,"library":{"type":"user","id":9200014,"name":"vvoleman","links":{"alternate":{"href":"https:\/\/www.zotero.org\/vvoleman","type":"text\/html"}}},"links":{"self":{"href":"https:\/\/api.zotero.org\/users\/9200014\/collections\/UN67Z6ZP","type":"application\/json"},"alternate":{"href":"https:\/\/www.zotero.org\/vvoleman\/collections\/UN67Z6ZP","type":"text\/html"},"up":{"href":"https:\/\/api.zotero.org\/users\/9200014\/collections\/PRTMAH7I","type":"application\/json"}},"meta":{"numCollections":0,"numItems":1},"data":{"key":"UN67Z6ZP","version":35,"name":"Povinn\u00e9","parentCollection":"PRTMAH7I","relations":{}}},{"key":"PRTMAH7I","version":29,"library":{"type":"user","id":9200014,"name":"vvoleman","links":{"alternate":{"href":"https:\/\/www.zotero.org\/vvoleman","type":"text\/html"}}},"links":{"self":{"href":"https:\/\/api.zotero.org\/users\/9200014\/collections\/PRTMAH7I","type":"application\/json"},"alternate":{"href":"https:\/\/www.zotero.org\/vvoleman\/collections\/PRTMAH7I","type":"text\/html"}},"meta":{"numCollections":2,"numItems":1},"data":{"key":"PRTMAH7I","version":29,"name":"Sekce A","parentCollection":false,"relations":{}}},{"key":"DVD429EA","version":2,"library":{"type":"user","id":9200014,"name":"vvoleman","links":{"alternate":{"href":"https:\/\/www.zotero.org\/vvoleman","type":"text\/html"}}},"links":{"self":{"href":"https:\/\/api.zotero.org\/users\/9200014\/collections\/DVD429EA","type":"application\/json"},"alternate":{"href":"https:\/\/www.zotero.org\/vvoleman\/collections\/DVD429EA","type":"text\/html"}},"meta":{"numCollections":0,"numItems":2},"data":{"key":"DVD429EA","version":2,"name":"Test 1","parentCollection":false,"relations":{}}}';

        return $str;
    }

    /**
     * @inheritDoc
     */
    public function withBody(\Psr\Http\Message\StreamInterface $body)
    {
        // TODO: Implement withBody() method.
    }

    /**
     * @inheritDoc
     */
    public function getStatusCode()
    {
        // TODO: Implement getStatusCode() method.
    }

    /**
     * @inheritDoc
     */
    public function withStatus($code, $reasonPhrase = '')
    {
        // TODO: Implement withStatus() method.
    }

    /**
     * @inheritDoc
     */
    public function getReasonPhrase()
    {
        // TODO: Implement getReasonPhrase() method.
    }
}