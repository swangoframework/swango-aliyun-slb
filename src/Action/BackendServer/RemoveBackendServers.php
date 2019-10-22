<?php
namespace Swango\Aliyun\Slb\Action\BackendServer;
use Swango\Aliyun\Slb\Action\BaseAction;
use Swango\Aliyun\Slb\JsonBuilder\RemoveBackendServersJsonBuilder;
class RemoveBackendServers extends BaseAction {
    public function __construct(RemoveBackendServersJsonBuilder $helper) {
        parent::__construct();
        $this->request->setQueryParameter('LoadBalancerId', $this->config['balancer_id']);
        $this->request->setQueryParameter('BackendServers', $helper->__toString());
    }
    public function getResult() {
        $result = parent::getResult();
        return $result->BackendServers->BackendServer;
    }
}