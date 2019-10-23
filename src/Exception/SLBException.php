<?php
namespace Swango\Aliyun\Slb\Exception;
class SLBException extends \Exception {
    public function __construct(string $message = "") {
        parent::__construct($message);
    }
}