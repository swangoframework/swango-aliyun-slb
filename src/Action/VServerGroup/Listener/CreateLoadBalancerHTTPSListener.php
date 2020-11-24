<?php
namespace Swango\Aliyun\Slb\Action\VServerGroup\Listener;
use Swango\Aliyun\Slb\Action\BaseAction;
use Swango\Aliyun\Slb\LocalHTTPListener;
use Swango\Aliyun\Slb\LocalServer;
class CreateLoadBalancerHTTPSListener extends BaseAction {
    public function __construct() {
        parent::__construct();
        $this->request->setQueryParameter('LoadBalancerId', $this->config['balancer_id']);
        $this->request->setQueryParameter('Bandwidth', -1);
        $this->request->setQueryParameter('HealthCheck', 'off');
        $this->request->setQueryParameter('StickySession', 'off');
        $this->request->setQueryParameter('ListenerPort',
            $this->config['balancer_listener_port'] ?? LocalHTTPListener::BALANCER_LISTENER_PORT);
        $this->request->setQueryParameter('StickySession', 'off');
        $this->request->setQueryParameter('BackendServerPort', LocalServer::getServerPort());
    }
}