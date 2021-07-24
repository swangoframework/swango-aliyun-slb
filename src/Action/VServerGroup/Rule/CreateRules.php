<?php
namespace Swango\Aliyun\Slb\Action\VServerGroup\Rule;
use Swango\Aliyun\Slb\Action\BaseAction;
use Swango\Aliyun\Slb\JsonBuilder\CreateRulesJsonBuilder;
use Swango\Aliyun\Slb\LocalHTTPListener;
class CreateRules extends BaseAction {
    public function __construct(CreateRulesJsonBuilder $helper = null) {
        parent::__construct();
        $this->request->setQueryParameter('LoadBalancerId', $this->config->balancer_id);
        $this->request->setQueryParameter('ListenerPort',
            $this->config->balancer_listener_port ?? LocalHTTPListener::BALANCER_LISTENER_PORT);
        if (isset($helper)) {
            $this->request->setQueryParameter('RuleList', $helper->toString());
        }
    }
    public function getResult() {
        $result = parent::getResult();
        return $result->Rules->Rule;
    }
}