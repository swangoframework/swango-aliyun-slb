<?php
namespace Swango\Aliyun\Slb\Exception;
class LocalHTTPListenerIsNotAvailableException extends SLBException {
    public function __construct() {
        parent::__construct('local HTTP listener is not available');
    }
}