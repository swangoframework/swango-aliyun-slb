<?php
namespace Swango\Aliyun\Slb\Scene;
use Swango\Aliyun\Slb\Action\VServerGroup\BackendServer\RemoveVServerGroupBackendServers;
use Swango\Aliyun\Slb\JsonBuilder\RemoveBackendServersJsonBuilder;
use Swango\Aliyun\Slb\LocalServer;
use Swango\Aliyun\Slb\LocalVServerGroup;
class ShutdownLocalServerFromVServerGroup {
    public static function shutdown() {
        if (LocalVServerGroup::isAvailable(false)) {
            if (LocalServer::isAvailable(false)) {
                $builder = new RemoveBackendServersJsonBuilder();
                $builder->addServer(LocalServer::getServerId());
                $action = new RemoveVServerGroupBackendServers($builder);
                $action->getResult();
            }
        }
    }
}