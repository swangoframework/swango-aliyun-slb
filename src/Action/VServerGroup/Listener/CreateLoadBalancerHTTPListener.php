<?php
namespace Swango\Aliyun\Slb\Action\VServerGroup\Listener;
use Swango\Aliyun\Slb\Action\BaseAction;
use Swango\Aliyun\Slb\LocalVServerGroup;
class CreateLoadBalancerHTTPListener extends BaseAction {
    public function __construct() {
        parent::__construct();
        $this->request->setQueryParameter('LoadBalancerId', $this->config['balancer_id']);
        $this->request->setQueryParameter('HealthCheck', 'on');
        $this->request->setQueryParameter('ListenerPort', '80');
        $this->request->setQueryParameter('StickySession', 'off');
        $this->request->setQueryParameter('Description', \Swango\Environment::getName());
        $this->request->setQueryParameter('HealthCheckConnectPort', '$_ip');
        $this->request->setQueryParameter('HealthCheckDomain',
            \Swango\Environment::getServiceConfig()->http_server_port);
        $this->request->setQueryParameter('HealthCheckInterval', 10);
        $this->request->setQueryParameter('HealthCheckTimeout', 5);
        $this->request->setQueryParameter('HealthCheckURI', '/');
        $this->request->setQueryParameter('HealthyThreshold', '3');
        $this->request->setQueryParameter('UnhealthyThreshold', '3');
        $this->request->setQueryParameter('VServerGroupId', LocalVServerGroup::getGroupId());
    }
    public function getResult() {
        return parent::getResult();
    }
}