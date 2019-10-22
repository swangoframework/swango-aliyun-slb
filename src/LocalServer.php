<?php
namespace Swango\Aliyun\Slb;
/**
 * Class LocalServer
 */
class LocalServer extends \BaseClient {
    public static $local_id;
    protected const METHOD = 'GET', HOST = '100.100.100.200', PATH = '/2016-01-01/meta-data/instance-id';
    public static function getServerId() {
        if (! isset(self::$local_id)) {
            $client = new self();
            $client->makeClient();
            $response = $client->sendHttpRequest()->recv();
            if ($response->getStatusCode() !== 200) {
                throw new \ApiErrorException("get server id error,code:{$response->getStatusCode()}");
            }
            self::$local_id = $response->getBody();
        }
        return self::$local_id;
    }
}