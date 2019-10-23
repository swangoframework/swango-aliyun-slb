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
        if (! isset(self::$group_id)) {
            $describe_action = new DescribeVServerGroups();
            $groups = $describe_action->getResult();
            foreach ($groups as $group) {
                if ($group->VServerGroupName === \Swango\Environment::getName()) {
                    self::$group_id = $group->VServerGroupId;
                }
            }
            if (! isset(self::$group_id) && $auto_build) {
                $create_action = new CreateVServerGroup();
                $result = $create_action->getResult();
                self::$group_id = $result->VServerGroupId;
                self::$group_backend_servers = $result->BackendServer;
            }
        }
        if (isset(self::$group_id)) {
            throw new LocalVServerGroupIsNotAvailableException();
        }
        return self::$group_id;
    }
    public static function getBackendServers() {
        if (! isset(self::$group_backend_servers)) {
            $action = new DescribeVServerGroupAttribute();
            self::$group_backend_servers = $action->getResult();
        }
        return self::$group_backend_servers;
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