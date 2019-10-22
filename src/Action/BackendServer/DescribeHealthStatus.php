<?php
namespace Swango\Aliyun\Slb\Action\BackendServer;
use Swango\Aliyun\Slb\Action\BaseAction;
/**
 * get backend server list of balancer
 * Class DescribeHealthStatus
 * @return array
 * [
 *      {
 *          "BackendServers":"",
 *          "ServerId":"",
 *          "Port":"",
 *          "ServerIp":"",
 *          "Protocol":"",
 *          "ListenerPort":""
 *      }
 * ];
 */
class DescribeHealthStatus extends BaseAction {
    public function __construct() {
        parent::__construct();
        $this->request->setQueryParameter('LoadBalancerId', $this->config['balancer_id']);
    }
    public function getResult() {
        $result = parent::getResult();
        return $result->BackendServers->BackendServer;
    }
}