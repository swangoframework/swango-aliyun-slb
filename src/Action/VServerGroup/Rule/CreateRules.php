<?php
namespace Swango\Aliyun\Slb\Action\VServerGroup\Rule;
use Swango\Aliyun\Slb\Action\BaseAction;
use Swango\Aliyun\Slb\JsonBuilder\CreateRulesJsonBuilder;
class CreateRules extends BaseAction {
    public function __construct(CreateRulesJsonBuilder $helper = null) {
        parent::__construct();
        $this->request->setQueryParameter('LoadBalancerId', $this->config['balancer_id']);
        if (isset($helper)) {
            $this->request->setQueryParameter('RuleList', $helper->__toString());
        }
    }
    public function getResult() {
        $result = parent::getResult();
        return $result->Rules;
    }
}