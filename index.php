<?php

use vvoleman\ZoteroApi\Endpoint\AbstractEndpoint;
use vvoleman\ZoteroApi\Endpoint\Collections;
use vvoleman\ZoteroApi\Exceptions\ZoteroBadRequestException;
use vvoleman\ZoteroApi\Source\KeysSource;
use vvoleman\ZoteroApi\ZoteroApi;

require_once "vendor/autoload.php";

$dotenv = \Dotenv\Dotenv::createImmutable(".",[".env.test.local"],true);
$dotenv->safeLoad();
try {
    $api = (new ZoteroApi($_ENV["API_KEY"], new \vvoleman\ZoteroApi\Source\UsersSource(9200014)))
        ->setEndpoint((new Collections("HH8ENUPI"))->setEndpoint(new \vvoleman\ZoteroApi\Endpoint\Items(AbstractEndpoint::ALL)))
        ->run();
} catch (ZoteroBadRequestException | Exception $e) {
    dd($e);
}

try {
    dd($api->getBody());
} catch (Exception $e) {
    dd($e);
}