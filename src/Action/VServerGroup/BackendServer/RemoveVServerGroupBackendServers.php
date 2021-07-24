<?php
namespace Swango\Aliyun\Slb\Action\VServerGroup\BackendServer;
use Swango\Aliyun\Slb\Action\BaseAction;
use Swango\Aliyun\Slb\JsonBuilder\RemoveBackendServersJsonBuilder;
use Swango\Aliyun\Slb\LocalVServerGroup;
class RemoveVServerGroupBackendServers extends BaseAction {
    public function __construct(RemoveBackendServersJsonBuilder $helper = null) {
        parent::__construct();
        $this->request->setQueryParameter('LoadBalancerId', $this->config->balancer_id);
        $this->request->setQueryParameter('BackendServers', $helper->toString());
        $this->request->setQueryParameter('VServerGroupId', LocalVServerGroup::getGroupId());
    }
    public function getResult() {
        $result = parent::getResult();
        LocalVServerGroup::setBackendServers($result->BackendServers->BackendServer);
        return (object)[
            'VServerGroupId' => $result->VServerGroupId,
            'BackendServer' => $result->BackendServers->BackendServer
        ];
    }
}