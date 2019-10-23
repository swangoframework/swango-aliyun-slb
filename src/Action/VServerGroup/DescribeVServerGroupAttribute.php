<?php
namespace Swango\Aliyun\Slb\Action\VServerGroup;
use Swango\Aliyun\Slb\Action\BaseAction;
use Swango\Aliyun\Slb\LocalVServerGroup;
class DescribeVServerGroupAttribute extends BaseAction {
    public function __construct(string $group_id = null) {
        if (! isset($group_id)) {
            $group_id = LocalVServerGroup::getGroupId();
        }
        parent::__construct();
        $this->request->setQueryParameter('VServerGroupId', $group_id);
    }
    public function getResult() {
        $result = parent::getResult();
        return $result->BackendServers->BackendServer;
    }
}