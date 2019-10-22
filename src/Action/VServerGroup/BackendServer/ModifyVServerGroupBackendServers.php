<?php
namespace Swango\Aliyun\Slb\Action\VServerGroup\BackendServer;
use Swango\Aliyun\Slb\Action\BaseAction;
use Swango\Aliyun\Slb\JsonBuilder\SetBackendServersJsonBuilder;
use Swango\Aliyun\Slb\LocalVServerGroup;
class ModifyVServerGroupBackendServers extends BaseAction {
    public function __construct(SetBackendServersJsonBuilder $helper = null) {
        parent::__construct();
        $this->request->setQueryParameter('LoadBalancerId', $this->config['balancer_id']);
        $this->request->setQueryParameter('NewBackendServers', $helper->__toString());
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