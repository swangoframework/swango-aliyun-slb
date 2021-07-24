<?php
namespace Swango\Aliyun\Slb;
use Swango\Aliyun\Slb\Action\VServerGroup\CreateVServerGroup;
use Swango\Aliyun\Slb\Action\VServerGroup\DescribeVServerGroupAttribute;
use Swango\Aliyun\Slb\Action\VServerGroup\DescribeVServerGroups;
use Swango\Aliyun\Slb\Exception\LocalVServerGroupIsNotAvailableException;
/**
 * Class LocalVServerGroup
 */
class LocalVServerGroup {
    private static $group_id, $group_backend_servers;
    public static function getGroupId(bool $auto_build = true) {
        $config = Config::getCurrent();
        if (! isset($config->group_id)) {
            $describe_action = new DescribeVServerGroups();
            $groups = $describe_action->getResult();
            foreach ($groups as $group) {
                if ($group->VServerGroupName === \Swango\Environment::getName()) {
                    $config->group_id = $group->VServerGroupId;
                }
            }
            if (! isset($config->group_id) && $auto_build) {
                $create_action = new CreateVServerGroup();
                $result = $create_action->getResult();
                $config->group_id = $result->VServerGroupId;
                $config->group_backend_servers = $result->BackendServer;
            }
        }
        if (! isset($config->group_id)) {
            throw new LocalVServerGroupIsNotAvailableException();
        }
        return $config->group_id;
    }
    public static function getBackendServers() {
        $config = Config::getCurrent();
        if (! isset($config->group_backend_servers)) {
            $action = new DescribeVServerGroupAttribute();
            $config->group_backend_servers = $action->getResult();
        }
        return $config->group_backend_servers;
    }
    public static function setBackendServers(?array $servers) {
        $config = Config::getCurrent();
        $config->group_backend_servers = $servers;
    }
    public static function isAvailable(bool $auto_build = true): bool {
        try {
            self::getGroupId($auto_build);
            return true;
        } catch (LocalVServerGroupIsNotAvailableException $e) {
            return false;
        }
    }
}