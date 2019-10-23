<?php
namespace Swango\Aliyun\Slb\Exception;
class InvalidParameterException extends SLBException {
    public function __construct($key, $value) {
        parent::__construct("has invalid parameter key:$key|value:$value");
    }
}