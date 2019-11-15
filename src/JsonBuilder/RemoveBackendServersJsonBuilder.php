<?php
namespace Swango\Aliyun\Slb\JsonBuilder;
class RemoveBackendServersJsonBuilder {
    private $array = [];
    public function __toString() {
        return \Json::encode($this->array);
    }
    public function addServer(string $server_id, int $port): self {
        $server = [];
        $server['ServerId'] = $server_id;
        $server['Port'] = $port;
        $this->array[] = $server;
        return $this;
    }
}