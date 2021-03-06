<?php
namespace Swango\Aliyun\Slb\Action\VServerGroup\Rule;
use Swango\Aliyun\Slb\Action\BaseAction;
use Swango\Aliyun\Slb\LocalRule;
use Swango\Aliyun\Slb\LocalServer;
use Swango\Aliyun\Slb\LocalVServerGroup;
class SetRule extends BaseAction {
    public function __construct() {
        parent::__construct();
        $this->request->setQueryParameter('RuleId', LocalRule::getRuleId());
        $this->request->setQueryParameter('VServerGroupId', LocalVServerGroup::getGroupId());
        $this->request->setQueryParameter('ListenerSync', 'off');
        $this->request->setQueryParameter('StickySession', 'off');
        $this->request->setQueryParameter('HealthCheck', 'on');
        $this->request->setQueryParameter('HealthCheckConnectPort', LocalServer::getServerPort());
        $this->request->setQueryParameter('HealthCheckTimeout', 5);
        $this->request->setQueryParameter('HealthCheckInterval', 10);
        $this->request->setQueryParameter('HealthCheckHttpCode', 'http_2xx');
        $this->request->setQueryParameter('HealthCheckDomain', '$_ip');
        $this->request->setQueryParameter('HealthCheckURI', '/');
        $this->request->setQueryParameter('HealthyThreshold', '3');
        $this->request->setQueryParameter('UnhealthyThreshold', '3');
        $this->request->setQueryParameter('Scheduler', 'wrr');
    }
}