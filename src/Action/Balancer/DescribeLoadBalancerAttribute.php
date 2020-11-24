<?php
namespace Swango\Aliyun\Slb\Action\Balancer;
use Swango\Aliyun\Slb\Action\BaseAction;
class DescribeLoadBalancerAttribute extends BaseAction {
    public function __construct() {
        parent::__construct();
        $this->request->setQueryParameter('LoadBalancerId', $this->config['balancer_id']);
    }
}