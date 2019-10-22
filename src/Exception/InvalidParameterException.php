<?php
namespace Swango\Aliyun\Slb\Exception;
class InvalidParameterException extends \Exception {
    public function __construct($key, $value) {
        parent::__construct('Parameter Invalid', "Has Invalid Parameters key:$key|value:$value");
    }
}