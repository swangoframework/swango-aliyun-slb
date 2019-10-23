<?php
namespace Swango\Aliyun\Slb\Exception;
class LocalServerIsNotAvailableException extends SLBException {
    public function __construct() {
        parent::__construct('local server is not available');
    }
}