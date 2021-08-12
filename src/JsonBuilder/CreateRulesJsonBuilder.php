<?php
namespace Swango\Aliyun\Slb\JsonBuilder;
class CreateRulesJsonBuilder {
    private $array = [];
    public function toString() {
        return \Json::encode($this->array);
    }
    public function addRule(string $role_name, ?string $host, ?string $url, $group_id): self {
        $rule = [];
        $rule['RuleName'] = $role_name;
        if (isset($host)) {
            $rule['Domain'] = $host;
        }
        if (isset($url)) {
            $rule['Url'] = $url;
        } else {
            throw new \Swango\Aliyun\Slb\Exception\SLBException('invalid rule');
        }
        $rule['VServerGroupId'] = $group_id;
        $this->array[] = $rule;
        return $this;
    }
}