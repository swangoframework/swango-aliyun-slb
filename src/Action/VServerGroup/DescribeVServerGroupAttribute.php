<?php
namespace Swango\Aliyun\Slb\Action\VServerGroup;
use Swango\Aliyun\Slb\Action\BaseAction;
use Swango\Aliyun\Slb\LocalVServerGroup;
class DescribeVServerGroupAttribute extends BaseAction {
    public function __construct() {
        parent::__construct();
        $this->request->setQueryParameter('VServerGroupId', LocalVServerGroup::getGroupId());
    }
    public function getResult() {
        $result = parent::getResult();
        return $result->BackendServers->BackendServer;
    }
}