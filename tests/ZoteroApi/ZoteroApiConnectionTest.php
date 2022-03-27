<?php

namespace vvoleman\ZoteroApi\Tests\ZoteroApi;

use Dotenv\Dotenv;
use vvoleman\ZoteroApi\Exceptions\ZoteroAccessDeniedException;
use vvoleman\ZoteroApi\Exceptions\ZoteroBadRequestException;
use vvoleman\ZoteroApi\Exceptions\ZoteroConnectionException;
use vvoleman\ZoteroApi\Source\KeysSource;
use vvoleman\ZoteroApi\Source\UsersSource;
use vvoleman\ZoteroApi\ZoteroApi;

/**
 * @
 */
class ZoteroApiConnectionTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @group Integration
     * @dataProvider connectionProvider
     */
    public function testConnectionAndAuth($key, bool $pass)
    {
        try {
            $api = new ZoteroApi($key, new KeysSource($key));
            $api->run();
        } catch (ZoteroConnectionException) {
            $msg = sprintf("Unable to connect to Zotero endpoint (%s).", ZoteroApi::API_ENDPOINT);
        } catch (ZoteroAccessDeniedException) {
            $msg = sprintf(
                "Your API key is invalid! (%s..%s letters..%s)",
                substr($_ENV["API_KEY"], 0, 4),
                strlen($_ENV["API_KEY"]) - 8,
                substr($_ENV["API_KEY"], -4)
            );
        }

        $this->assertEquals($pass, !isset($msg), $msg ?? "");
    }

    public function connectionProvider()
    {
        $path = realpath(__DIR__ . "/../../");
        $dotenv = Dotenv::createImmutable($path, [".env.test", ".env.test.local"], false);
        $dotenv->safeLoad();
        return [
            [$_ENV["API_KEY"] ?? "", true]
        ];
    }

}