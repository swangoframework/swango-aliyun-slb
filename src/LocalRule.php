<?php
namespace Swango\Aliyun\Slb;
use Swango\Aliyun\Slb\Action\VServerGroup\Listener\DescribeLoadBalancerHTTPListenerAttribute;
use Swango\Aliyun\Slb\Action\VServerGroup\Rule\CreateRules;
use Swango\Aliyun\Slb\JsonBuilder\CreateRulesJsonBuilder;
class LocalRule {
    private static $rule_id;
    public static function getRuleId() {
        if (! isset(self::$rule_id)) {
            $describe_action = new DescribeLoadBalancerHTTPListenerAttribute();
            $result = $describe_action->getResult();
            foreach ($result['Rule'] as $rule) {
                if ($rule->RuleName === \Swango\Environment::getName()) {
                    self::$rule_id = $rule->RuleId;
                    break;
                }
            }
            if (! isset(self::$rule_id)) {
                $builder = new CreateRulesJsonBuilder();
                $builder->addRule(\Swango\Environment::getName(), \Swango\Environment::getName(),
                    LocalVServerGroup::getGroupId());
                $create_action = new CreateRules($builder);
                $rules = $create_action->getResult();
                foreach ($rules as $rule) {
                    if ($rule->RuleName === \Swango\Environment::getName()) {
                        self::$rule_id = $rule->RuleId;
                        break;
                    }
                }
            }
            if (! isset(self::$rule_id)) {
                throw new \ApiErrorException('unknown situation');
            }
            return self::$rule_id;
        }
    }
}