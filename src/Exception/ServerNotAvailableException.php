<?php
namespace Swango\Aliyun\Slb\Exception;
class ServerNotAvailableException extends SLBException {
    public function __construct($name) {
        parent::__construct("server[$name] not found");
    }
}