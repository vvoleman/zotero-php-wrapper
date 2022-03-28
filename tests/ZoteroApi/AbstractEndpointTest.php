<?php

namespace ZoteroApi\Tests;

use PHPUnit\Framework\TestCase;
use ZoteroApi\Endpoint\AbstractEndpoint;
use ZoteroApi\Endpoint\Collections;
use ZoteroApi\Endpoint\Items;
use ZoteroApi\Endpoint\Publications;
use ZoteroApi\Endpoint\Tags;
use ZoteroApi\Exceptions\ZoteroBadRequestException;
use ZoteroApi\Exceptions\ZoteroInvalidChainingException;
use ZoteroApi\Source\AbstractSource;
use ZoteroApi\Source\UsersSource;

class AbstractEndpointTest extends TestCase
{

    /**
     * @group Unit
     * @dataProvider EndpointAdditionProvider
     * @param AbstractEndpoint $parent
     * @param AbstractEndpoint $child
     * @param bool $pass
     */
    public function testCanAddEndpointToEndpoint(AbstractEndpoint $parent, AbstractEndpoint $child, bool $pass)
    {
        $isOK = true;
        try {
            $parent->setEndpoint($child);
        } catch (ZoteroInvalidChainingException $exception){
            $isOK = false;
        }

        $this->assertEquals($pass,$isOK);
    }

    public function EndpointAdditionProvider()
    {
        return [
            [new Collections("abcd"),new Items("items"),true],
            [new Collections("abcd"),new Collections("colls"),true],
            [new Collections("top"),new Items("items"),false],
            [new Collections(""),new Collections("colls"),false],
            [new Items("ff"),new Tags(AbstractEndpoint::ALL),true],
            [new Items("ff"),new Collections(AbstractEndpoint::ALL),false],
            [new Tags(AbstractEndpoint::ALL),new Collections("f"),false]
        ];
    }
    
    /**
     * @group Unit
     * @dataProvider paramsProvider
     */
    public function testEndpointConstants(AbstractEndpoint $endpoint, string $expected, bool $pass)
    {
        $this->assertEquals($pass,$endpoint->getURLPath() == $expected);
    }

    public function paramsProvider(): array
    {
        return [
            [new Collections(AbstractEndpoint::ALL), "/collections",true],
            [new Collections(AbstractEndpoint::TOP), "/collections/top",true],
            [new Publications(AbstractEndpoint::TRASH), "/publications/trash",true],
            [new Collections("123456"), "/collections/123456",true],
            [new Tags("ff"),"/tags/ff",true],
            [
                (new Collections("123456"))
                ->setEndpoint(new Items(AbstractEndpoint::ALL)),
                "/collections/123456/items",
                true
            ],[
                (new Collections("123456"))
                ->setEndpoint(new Items(AbstractEndpoint::TOP)),
                "/collections/123456/items/top",
                true
            ]
        ];
    }

}