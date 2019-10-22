<?php
namespace Swango\Aliyun\Slb\Action\VServerGroup\BackendServer;
use Swango\Aliyun\Slb\Action\BaseAction;
use Swango\Aliyun\Slb\JsonBuilder\AddBackendServersJsonBuilder;
use Swango\Aliyun\Slb\LocalVServerGroup;
class AddVServerGroupBackendServers extends BaseAction {
    public function __construct(AddBackendServersJsonBuilder $helper = null) {
        parent::__construct();
        $this->request->setQueryParameter('LoadBalancerId', $this->config['balancer_id']);
        $this->request->setQueryParameter('BackendServers', $helper->__toString());
        $this->request->setQueryParameter('VServerGroupId', LocalVServerGroup::getGroupId());
    }
    public function getResult() {
        $result = parent::getResult();
        return [
            'VServerGroupId' => $result->VServerGroupId,
            'BackendServer' => $result->BackendServers->BackendServer
        ];
    }
}