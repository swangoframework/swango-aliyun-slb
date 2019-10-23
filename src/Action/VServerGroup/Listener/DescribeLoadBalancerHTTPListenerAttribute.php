<?php
namespace Swango\Aliyun\Slb\Action\VServerGroup\Listener;
use Swango\Aliyun\Slb\Action\BaseAction;
use Swango\Aliyun\Slb\Exception\RequestErrorException;
use Swango\Aliyun\Slb\LocalHTTPListener;
class DescribeLoadBalancerHTTPListenerAttribute extends BaseAction {
    public function __construct() {
        parent::__construct();
        $this->request->setQueryParameter('LoadBalancerId', $this->config['balancer_id']);
        $this->request->setQueryParameter('ListenerPort', LocalHTTPListener::BALANCER_LISTENER_PORT);
    }
    public function getResult() {
        try {
            $result = parent::getResult();
        } catch (RequestErrorException $e) {
            return (object)[
                'Status' => 'none',
                'Rule' => []
            ];
        }
        return (object)[
            'Status' => $result->Status,
            'Rule' => $result->Rules->Rule
        ];
    }
}