<?php
namespace Swango\Aliyun\Slb\Action\VServerGroup\Rule;
use Swango\Aliyun\Slb\Action\BaseAction;
use Swango\Aliyun\Slb\LocalRule;
class DescribeRuleAttribute extends BaseAction {
    public function __construct(string $role_id = null) {
        parent::__construct();
        if (! isset($role_id)) {
            $role_id = LocalRule::getRuleId();
        }
        $this->request->setQueryParameter('RuleId', $role_id);
    }
    public function getResult() {
        $result = parent::getResult();
        return (object)[
            'VServerGroupId' => $result->VServerGroupId,
            'ListenerSync' => $result->ListenerSync,
            'Domain' => $result->Domain ?? null,
            'Url' => $result->Url ?? null,
            'HealthCheck' => $result->HealthCheck ?? 'off'
        ];
    }
}