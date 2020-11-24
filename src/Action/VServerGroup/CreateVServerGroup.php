<?php
namespace Swango\Aliyun\Slb\Action\VServerGroup;
use Swango\Aliyun\Slb\Action\BaseAction;
use Swango\Aliyun\Slb\JsonBuilder\AddBackendServersJsonBuilder;
class CreateVServerGroup extends BaseAction {
    public function __construct(?AddBackendServersJsonBuilder $helper = null, string $group_name = null) {
        parent::__construct();
        $this->request->setQueryParameter('LoadBalancerId', $this->config['balancer_id']);
        if (isset($helper)) {
            $this->request->setQueryParameter('BackendServers', $helper->toString());
        }
        if (! isset($group_name)) {
            $group_name = \Swango\Environment::getName();
        }
        $this->request->setQueryParameter('VServerGroupName', $group_name);
    }
    public function getResult() {
        $result = parent::getResult();
        return (object)[
            'VServerGroupId' => $result->VServerGroupId,
            'BackendServer' => $result->BackendServers->BackendServer
        ];
    }
}