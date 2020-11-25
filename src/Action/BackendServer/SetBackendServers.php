<?php
namespace Swango\Aliyun\Slb\Action\BackendServer;
use Swango\Aliyun\Slb\Action\BaseAction;
use Swango\Aliyun\Slb\JsonBuilder\SetBackendServersJsonBuilder;
/**
 * set backend servers weights
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
class SetBackendServers extends BaseAction {
    public function __construct(SetBackendServersJsonBuilder $helper) {
        parent::__construct();
        $this->request->setQueryParameter('LoadBalancerId', $this->config['balancer_id']);
        $this->request->setQueryParameter('BackendServers', $helper->toString());
    }
    public function getResult() {
        $result = parent::getResult();
        return $result->BackendServers->BackendServer;
    }
}