<?php
namespace Swango\Aliyun\Slb\Exception;
class RequestErrorException extends \Exception {
    public function __construct() {
        parent::__construct('request is failed');
    }
}