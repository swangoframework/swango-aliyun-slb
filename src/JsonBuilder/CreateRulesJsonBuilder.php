<?php
namespace Swango\Aliyun\Slb\JsonBuilder;
class CreateRulesJsonBuilder {
    private $array = [];
    public function __toString() {
        return \Json::encode($this->array);
    }
    public function addRule(string $role_name, string $url, $group_id): self {
        $rule = [];
        $rule['RuleName'] = $role_name;
        $rule['Url'] = $url;
        $rule['VServerGroupId'] = $group_id;
        $this->array[] = $rule;
        return $this;
    }
}