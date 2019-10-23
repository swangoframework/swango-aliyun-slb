<?php
namespace Swango\Aliyun\Slb\Exception;
class LocalRuleIsNotAvailableException extends SLBException {
    public function __construct() {
        parent::__construct('local rule is not available');
    }
}