<?php
namespace Swango\Aliyun\Slb\Action\VServerGroup\Rule;
use Swango\Aliyun\Slb\Action\BaseAction;
use Swango\Aliyun\Slb\LocalRule;
use Swango\Aliyun\Slb\LocalVServerGroup;
class SetRule extends BaseAction {
    public function __construct() {
        parent::__construct();
        $this->request->setQueryParameter('RuleId', LocalRule::getRuleId());
        $this->request->setQueryParameter('VServerGroupId', LocalVServerGroup::getGroupId());
        $this->request->setQueryParameter('ListenerSync', 'on');
    }
}