<?php

namespace vvoleman\ZoteroApi\Tests;

use PHPUnit\Framework\TestCase;
use vvoleman\ZoteroApi\Endpoint\AbstractEndpoint;
use vvoleman\ZoteroApi\Endpoint\Collections;
use vvoleman\ZoteroApi\Endpoint\Tags;
use vvoleman\ZoteroApi\Source\AbstractSource;
use vvoleman\ZoteroApi\Source\GroupsSource;
use vvoleman\ZoteroApi\Source\KeysSource;
use vvoleman\ZoteroApi\Source\UsersSource;
use vvoleman\ZoteroApi\ZoteroApi;


class AbstractSourceTest extends TestCase
{
    /**
     * @group Unit
     * @dataProvider sourcesProvider
     */
    public function testSources(AbstractSource $source, string $str)
    {
        $this->assertEquals($str,$source,"Partial URL path of a source is not correct!");
    }

    public function sourcesProvider(): array
    {
        return [
            [new GroupsSource("4678965"),"/groups/4678965"],
            [new UsersSource("123456"),"/users/123456"],
        ];
    }

    /**
     * @group Unit
     * @dataProvider CanBeUsedProvider
     */
    public function testCanBeUsedWith(AbstractSource $source, AbstractEndpoint $endpoint, bool $pass)
    {
        $this->assertEquals($pass,$source->canBeUsedWith($endpoint));
    }

    public function CanBeUsedProvider()
    {
        return[
            [new GroupsSource("abcd"),new Collections("cs"),true],
            [new GroupsSource("abcd"),new Tags(AbstractEndpoint::ALL),false],
            [new UsersSource("abcd"),new Collections("cd"),true],
            [new UsersSource("abcd"),new Tags("f"),false],
            [new KeysSource("abcd"),new Collections(AbstractEndpoint::ALL),false]
        ];
    }

    /**
     * @group Unit
     */
    public function testGetKey()
    {
        $source = new GroupsSource("abcd");
        $this->assertEquals("abcd",$source->getKey());
    }
}