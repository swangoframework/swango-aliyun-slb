<?php
namespace Swango\Aliyun\Slb\Action\VServerGroup\Rule;
use Swango\Aliyun\Slb\Action\BaseAction;
use Swango\Aliyun\Slb\JsonBuilder\DeleteRulesJsonBuilder;
class DeleteRules extends BaseAction {
    public function __construct(DeleteRulesJsonBuilder $helper = null) {
        parent::__construct();
        $this->request->setQueryParameter('LoadBalancerId', $this->config['balancer_id']);
        if (isset($helper)) {
            $this->request->setQueryParameter('RuleIds', $helper->__toString());
        }
    }
}