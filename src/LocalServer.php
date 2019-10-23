<?php
namespace Swango\Aliyun\Slb;
use Swango\Aliyun\Slb\Action\VServerGroup\BackendServer\AddVServerGroupBackendServers;
use Swango\Aliyun\Slb\Action\VServerGroup\DescribeVServerGroupAttribute;
use Swango\Aliyun\Slb\JsonBuilder\AddBackendServersJsonBuilder;
/**
 * Class LocalServer
 */
class LocalServer extends \BaseClient {
    private static $local_id;
    protected const METHOD = 'GET', HOST = '100.100.100.200', PATH = '/2016-01-01/meta-data/instance-id';
    public static function getServerId() {
        if (! isset(self::$local_id)) {
            $client = new self();
            $client->makeClient();
            $response = $client->sendHttpRequest()->recv();
            if ($response->getStatusCode() !== 200) {
                throw new \ApiErrorException("get server id error,code:{$response->getStatusCode()}");
            }
            self::$local_id = trim($response->getBody()->__toString());
        }
        return self::$local_id;
    }
    public static function getServerIp() {
        return \Swango\Environment::getServiceConfig()->local_ip;
    }
    public static function getServerPort() {
        return \Swango\Environment::getServiceConfig()->http_server_port;
    }
    public static function isAvailable(bool $auto_build = true): bool {
        $servers = (new DescribeVServerGroupAttribute())->getResult();
        foreach ($servers as $server) {
            if ($server->ServerId === self::getServerId()) {
                return true;
            }
        }
        if ($auto_build) {
            $builder = new AddBackendServersJsonBuilder();
            $builder->addServer(self::getServerId(), self::getServerPort(),
                \Swango\Environment::getServiceConfig()->worker_num);
            $action = new AddVServerGroupBackendServers($builder);
            $action->getResult();
            return true;
        } else {
            return false;
        }
    }
}