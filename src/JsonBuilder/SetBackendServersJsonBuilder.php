<?php
namespace Swango\Aliyun\Slb\JsonBuilder;
use Swango\Aliyun\Slb\Exception\InvalidParameterException;
class SetBackendServersJsonBuilder {
    const TYPE_ECS = 'ecs', TYPE_ENI = 'eni';
    private $array = [];
    public function toString() {
        return \Json::encode($this->array);
    }
    public function addServer(string $server_id, int $port, int $weight, ?string $description = null): self {
        if ($port < 1 || $port > 65535) {
            throw new InvalidParameterException('port', $port);
        }
        if ($weight < 0 || $weight > 100) {
            throw new InvalidParameterException('weight', $weight);
        }
        $server = [];
        $server['ServerId'] = $server_id;
        $server['Port'] = $port;
        $server['Weight'] = $weight;
        if (isset($description)) {
            $server['Description'] = $description;
        }
        $this->array[] = $server;
        return $this;
    }
}