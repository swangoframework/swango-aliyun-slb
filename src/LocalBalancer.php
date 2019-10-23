<?php
namespace Swango\Aliyun\Slb;
use Swango\Aliyun\Slb\Action\Balancer\DescribeLoadBalancerAttribute;
class LocalBalancer {
    const STATUS_ACTIVE = 'active', STATUS_INACTIVE = 'inactive', STATUS_LOCKED = 'locked';
    public static function isAvailable(): bool {
        $describe_action = new DescribeLoadBalancerAttribute();
        switch ($describe_action->getResult()->LoadBalancerStatus) {
            case self::STATUS_ACTIVE:
                return true;
            default :
                return false;
        }
    }
}