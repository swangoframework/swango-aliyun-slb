<?php
namespace Swango\Aliyun\Slb;
use Swango\Aliyun\Slb\Action\VServerGroup\Listener\CreateLoadBalancerHTTPListener;
use Swango\Aliyun\Slb\Action\VServerGroup\Listener\CreateLoadBalancerHTTPSListener;
use Swango\Aliyun\Slb\Action\VServerGroup\Listener\DescribeLoadBalancerHTTPListenerAttribute;
use Swango\Aliyun\Slb\Action\VServerGroup\Listener\DescribeLoadBalancerHTTPSListenerAttribute;
use Swango\Aliyun\Slb\Action\VServerGroup\Listener\StartLoadBalancerListener;
class LocalHTTPListener {
    const BALANCER_LISTENER_PORT = 80;
    const STATUS_STARTING = 'starting', STATUS_RUNNING = 'running', STATUS_CONFIGURING = 'configuring';
    const STATUS_STOPPING = 'stopping', STATUS_STOPPED = 'stopped', STATUS_NONE = 'none';
    public static function isAvailable(bool $auto_build = true): bool {
        $config = Config::getCurrent();

        if ($config->isHTTPS()) {
            $describe_action = new DescribeLoadBalancerHTTPSListenerAttribute();
        } else {
            $describe_action = new DescribeLoadBalancerHTTPListenerAttribute();
        }

        switch ($describe_action->getResult()->Status) {
            case self::STATUS_NONE:
                if ($auto_build) {
                    if ($config->isHTTP()) {
                        $create_action = new CreateLoadBalancerHTTPListener();
                        $create_action->getResult();
                    }
                    if ($config->isHTTPS()) {
                        $create_action = new CreateLoadBalancerHTTPSListener();
                        $create_action->getResult();
                    }
                    $start_action = new StartLoadBalancerListener();
                    $start_action->getResult();
                    return true;
                } else {
                    return false;
                }
            case self::STATUS_STARTING:
            case self::STATUS_RUNNING:
                return true;
            default :
                return false;
        }
    }
}