<?php
namespace Swango\Aliyun\Slb\Action\VServerGroup;
use Swango\Aliyun\Slb\Action\BaseAction;
use Swango\Aliyun\Slb\LocalVServerGroup;
class DeleteVServerGroup extends BaseAction {
    public function __construct() {
        parent::__construct();
        $this->request->setQueryParameter('VServerGroupId', LocalVServerGroup::getGroupId());
    }
}