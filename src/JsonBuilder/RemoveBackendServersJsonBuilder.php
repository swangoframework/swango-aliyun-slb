<?php
namespace Swango\Aliyun\Slb\JsonBuilder;
class RemoveBackendServersJsonBuilder {
    private $array = [];
    public function __toString() {
        return \Json::encode($this->array);
    }
    public function addServer(string $server_id): self {
        $server = [];
        $server['ServerId'] = $server_id;
        $this->array[] = $server;
        return $this;
    }
}