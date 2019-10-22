<?php
namespace Swango\Aliyun\Slb\Action\VServerGroup;
use Swango\Aliyun\Slb\Action\BaseAction;
use Swango\Aliyun\Slb\JsonBuilder\AddBackendServersJsonBuilder;
class CreateVServerGroup extends BaseAction {
    public function __construct(?AddBackendServersJsonBuilder $helper = null) {
        parent::__construct();
        $this->request->setQueryParameter('LoadBalancerId', $this->config['balancer_id']);
        if (isset($helper)) {
            $this->request->setQueryParameter('BackendServers', $helper->__toString());
        }
        $this->request->setQueryParameter('VServerGroupName', \Swango\Environment::getName());
    }
    public function getResult() {
        $result = parent::getResult();
        return [
            'VServerGroupId' => $result->VServerGroupId,
            'BackendServer' => $result->BackendServers->BackendServer
        ];
    }
}