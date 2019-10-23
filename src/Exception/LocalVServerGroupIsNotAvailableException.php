<?php
namespace Swango\Aliyun\Slb\Exception;
class LocalVServerGroupIsNotAvailableException extends SLBException {
    public function __construct() {
        parent::__construct('local server group is not available');
    }
}