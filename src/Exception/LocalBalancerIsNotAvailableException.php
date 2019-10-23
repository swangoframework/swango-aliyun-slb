<?php
namespace Swango\Aliyun\Slb\Exception;
class LocalBalancerIsNotAvailableException extends SLBException {
    public function __construct() {
        parent::__construct('balancer is not available');
    }
}