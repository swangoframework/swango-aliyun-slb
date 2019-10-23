<?php
namespace Swango\Aliyun\Slb\JsonBuilder;
class DeleteRulesJsonBuilder {
    private $array = [];
    public function __toString() {
        return \Json::encode($this->array);
    }
    public function addRule(string $role_id): self {
        $this->array[] = $role_id;
        return $this;
    }
}