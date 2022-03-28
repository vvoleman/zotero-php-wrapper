<?php

use Dotenv\Dotenv;
use vvoleman\ZoteroApi\Endpoint\AbstractEndpoint;
use vvoleman\ZoteroApi\Endpoint\Collections;
use vvoleman\ZoteroApi\Endpoint\Items;
use vvoleman\ZoteroApi\Exceptions\ZoteroBadRequestException;
use vvoleman\ZoteroApi\Source\KeysSource;
use vvoleman\ZoteroApi\Source\UsersSource;
use vvoleman\ZoteroApi\ZoteroApi;

require_once "vendor/autoload.php";

$dotenv = Dotenv::createImmutable(".", [".env.test.local"], true);
$dotenv->safeLoad();
try {
    $api = (new ZoteroApi($_ENV["API_KEY"], new UsersSource(9200014)))
        ->setEndpoint(
            (new Collections("HH8ENUPI"))->setEndpoint(new Items(AbstractEndpoint::ALL))
        )
        ->run();
} catch (ZoteroBadRequestException | Exception $e) {
    dd($e);
}

$api = new ZoteroApi($_ENV["API_KEY"], new UsersSource("YOUR_USER_ID"));
$api->setEndpoint(
    (new Collections("COLLECTION_ID"))
        ->setEndpoint(new Items(AbstractEndpoint::ALL))
);