<?php
namespace Swango\Aliyun\Slb\Action\VServerGroup\Listener;
use Swango\Aliyun\Slb\Action\BaseAction;
class StartLoadBalancerListener extends BaseAction {
    public function __construct() {
        parent::__construct();
        $this->request->setQueryParameter('LoadBalancerId', $this->config['balancer_id']);
        $this->request->setQueryParameter('ListenerPort', \Swango\Environment::getServiceConfig()->http_server_port);
    }
    public function getResult() {
        return parent::getResult();
    }
}