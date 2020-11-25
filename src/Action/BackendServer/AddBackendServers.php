<?php
namespace Swango\Aliyun\Slb\Action\BackendServer;
use Swango\Aliyun\Slb\Action\BaseAction;
use Swango\Aliyun\Slb\JsonBuilder\AddBackendServersJsonBuilder;
/**
 * add backend servers (server must be running)
 * Class SetBackendServers
 * @return array
 * [
 *      {
 *          "ServerId":"",
 *          "Weight":"",
 *          "Description":"",
 *          "Type":""
 *      }
 * ];
 */
class AddBackendServers extends BaseAction {
    public function __construct(AddBackendServersJsonBuilder $helper) {
        parent::__construct();
        $this->request->setQueryParameter('LoadBalancerId', $this->config['balancer_id']);
        $this->request->setQueryParameter('BackendServers', $helper->toString());
    }
    public function getResult() {
        $result = parent::getResult();
        return $result->BackendServers->BackendServer;
    }
}