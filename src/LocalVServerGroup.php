<?php
namespace Swango\Aliyun\Slb;
use Swango\Aliyun\Slb\Action\VServerGroup\CreateVServerGroup;
use Swango\Aliyun\Slb\Action\VServerGroup\DescribeVServerGroups;
/**
 * Class LocalVServerGroup
 */
class LocalVServerGroup {
    private static $group_id;
    public static function getGroupId() {
        if (! isset(self::$group_id)) {
            $describe_action = new DescribeVServerGroups();
            $groups = $describe_action->getResult();
            $create_flag = true;
            foreach ($groups as $group) {
                if ($group->VServerGroupName === \Swango\Environment::getName()) {
                    self::$group_id = $group->VServerGroupId;
                    $create_flag = false;
                }
            }
            if ($create_flag) {
                $create_action = new CreateVServerGroup();
                self::$group_id = $create_action->getResult()['VServerGroupId'];
            }
        }
        return self::$group_id;
    }
}