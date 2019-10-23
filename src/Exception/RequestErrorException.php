<?php
namespace Swango\Aliyun\Slb\Exception;
class RequestErrorException extends \Exception {
    public function __construct($code, $message) {
        parent::__construct("request is failed.code:$code|message:$message");
    }
}