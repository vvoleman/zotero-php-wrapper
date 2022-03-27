<?php

use vvoleman\ZoteroApi\Endpoint\AbstractEndpoint;
use vvoleman\ZoteroApi\Endpoint\Collections;
use vvoleman\ZoteroApi\Source\UsersSource;
use vvoleman\ZoteroApi\Tests\Mock\MockClient;
use vvoleman\ZoteroApi\ZoteroApi;

require_once "vendor/autoload.php";

$api = (new ZoteroApi("abcd", new UsersSource("uuuiiiddd")))
    ->addEndpoint(new Collections(AbstractEndpoint::ALL))
    ->setClient(new MockClient())
    ->run();

dd($api->getHeaders());