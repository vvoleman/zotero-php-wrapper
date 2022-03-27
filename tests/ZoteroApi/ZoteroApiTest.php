<?php

namespace vvoleman\ZoteroApi\Tests;

use PHPUnit\Framework\TestCase;
use vvoleman\ZoteroApi\Endpoint\AbstractEndpoint;
use vvoleman\ZoteroApi\Endpoint\Collections;
use vvoleman\ZoteroApi\Endpoint\Items;
use vvoleman\ZoteroApi\Endpoint\Tags;
use vvoleman\ZoteroApi\Exceptions\ZoteroBadRequestException;
use vvoleman\ZoteroApi\Exceptions\ZoteroInvalidChainingException;
use vvoleman\ZoteroApi\Source\AbstractSource;
use vvoleman\ZoteroApi\Source\GroupsSource;
use vvoleman\ZoteroApi\Source\KeysSource;
use vvoleman\ZoteroApi\Source\UsersSource;
use vvoleman\ZoteroApi\Tests\Mock\MockClient;
use vvoleman\ZoteroApi\ZoteroApi;

class ZoteroApiTest extends TestCase
{

    /**
     * Tests if full links are properly generated
     *
     * @group Unit
     * @dataProvider endpointsProvider
     * @param ZoteroApi $api
     * @param string $expected
     */
    public function testGetFullLink(ZoteroApi $api, string $expected)
    {
        $this->assertEquals(ZoteroApi::API_ENDPOINT . $expected, (string)$api);
    }

    /**
     * @dataProvider zoteroApiProvider
     */
    public function testGetHeaders(ZoteroApi $api, string $url)
    {
        $this->assertIsArray($api->getHeaders(), "Headers type");
        $this->assertEquals($api->getVersion(), $api->getHeaders()["Zotero-API-Version"][0], "API Version");
    }

    /**
     * @group Unit
     * @throws ZoteroBadRequestException
     */
    public function zoteroApiProvider(): array
    {
        return [
            [
                (new ZoteroApi("abcd", new UsersSource("uuuiiiddd")))
                    ->setEndpoint(new Collections(AbstractEndpoint::ALL))
                    ->setClient(new MockClient())
                    ->run(),
                ZoteroApi::API_ENDPOINT . "/users/uuuiiiddd/collections"
            ]
        ];
    }

    public function endpointsProvider(): array
    {
        return [
            [
                (new ZoteroApi("abcd", new UsersSource("uuuiiiddd"))),
                "/users/uuuiiiddd"
            ],
            [
                (new ZoteroApi("abcd", new UsersSource("uuuiiiddd")))
                    ->setEndpoint(new Collections(AbstractEndpoint::ALL)),
                "/users/uuuiiiddd/collections"
            ],
            [
                (new ZoteroApi("abcd", new UsersSource("uuuiiiddd")))
                    ->setEndpoint(
                        (new Collections("kolekce"))
                            ->setEndpoint(new Items(AbstractEndpoint::TOP))
                    ),
                "/users/uuuiiiddd/collections/kolekce/items/top"
            ]
        ];
    }

    /**
     * @group Unit
     * @dataProvider SetEndpointsProvider
     */
    public function testSetEndpoint(ZoteroApi $api, AbstractEndpoint $endpoint, bool $pass)
    {
        if(!$pass){
            $this->expectException(ZoteroInvalidChainingException::class);
        }
        $response = $api->setEndpoint($endpoint);
        $this->assertInstanceOf(ZoteroApi::class,$response);
    }


    public function SetEndpointsProvider()
    {
        $apiUsers = new ZoteroApi("xxx-xxx-xxx",new UsersSource("uuu-uuu-uuu"));
        $apiKeys = new ZoteroApi("xxx-xxx-xxx",new KeysSource("xxx-xxx-xxx"));
        return [
            [$apiUsers,new Collections(AbstractEndpoint::TOP),true],
            [$apiUsers,new Items(AbstractEndpoint::ALL),true],
            [$apiUsers,new Tags(AbstractEndpoint::ALL),false],
            [$apiKeys,new Collections("fff"),false],
            [$apiKeys,new Items(AbstractEndpoint::ALL),false]
        ];
    }

}