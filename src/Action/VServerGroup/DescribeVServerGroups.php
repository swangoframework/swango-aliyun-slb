<?php
namespace Swango\Aliyun\Slb\Action\VServerGroup;
use Swango\Aliyun\Slb\Action\BaseAction;
class DescribeVServerGroups extends BaseAction {
    public function __construct() {
        parent::__construct();
        $this->request->setQueryParameter('LoadBalancerId', $this->config->balancer_id);
    }
    public function getResult() {
        $result = parent::getResult();
        return $result->VServerGroups->VServerGroup;
    }
}