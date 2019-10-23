<?php
namespace Swango\Aliyun\Slb\Action\VServerGroup\Rule;
use Swango\Aliyun\Slb\Action\BaseAction;
use Swango\Aliyun\Slb\LocalRule;
class DescribeRuleAttribute extends BaseAction {
    public function __construct() {
        parent::__construct();
        $this->request->setQueryParameter('RuleId', LocalRule::getRuleId());
    }
    public function getResult() {
        $result = parent::getResult();
        return (object)[
            'VServerGroupId' => $result->VServerGroupId,
            'ListenerSync' => $result->ListenerSync,
            'Url' => $result->Url
        ];
    }
}