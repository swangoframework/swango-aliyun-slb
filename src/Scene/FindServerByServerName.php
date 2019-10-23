<?php
namespace Swango\Aliyun\Slb\Scene;
use Swango\Aliyun\Slb\Action\VServerGroup\DescribeVServerGroupAttribute;
use Swango\Aliyun\Slb\Action\VServerGroup\DescribeVServerGroups;
use Swango\Aliyun\Slb\Exception\ServerNotAvailableException;
class FindServerByServerName {
    public static function find(string $server_name) {
        $describe_groups_action = new DescribeVServerGroups();
        $describe_groups = $describe_groups_action->getResult();
        foreach ($describe_groups as $group) {
            if ($group->VServerGroupName === $server_name) {
                $group_id = $group->VServerGroupId;
                break;
            }
        }
        if (isset($group_id)) {
            throw new ServerNotAvailableException($server_name);
        }
        $describe_servers_action = new DescribeVServerGroupAttribute($group_id);
        $describe_servers = $describe_servers_action->getResult();
        if (empty($describe_servers)) {
            throw new ServerNotAvailableException($server_name);
        }
        foreach ($describe_servers as $server) {
            if ($server->Weight > 0) {
                return;
            }
        }
        throw new ServerNotAvailableException($server_name);
    }
}