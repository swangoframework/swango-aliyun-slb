<?php
namespace Swango\Aliyun\Slb;
use Swango\Aliyun\Slb\Action\VServerGroup\Listener\DescribeLoadBalancerHTTPListenerAttribute;
use Swango\Aliyun\Slb\Action\VServerGroup\Rule\CreateRules;
use Swango\Aliyun\Slb\Action\VServerGroup\Rule\DescribeRuleAttribute;
use Swango\Aliyun\Slb\Action\VServerGroup\Rule\SetRule;
use Swango\Aliyun\Slb\Exception\LocalRuleIsNotAvailableException;
use Swango\Aliyun\Slb\JsonBuilder\CreateRulesJsonBuilder;
class LocalRule {
    private static $rule_id;
    public static function getRuleId(bool $auto_build = true) {
        if (! isset(self::$rule_id)) {
            $describe_action = new DescribeLoadBalancerHTTPListenerAttribute();
            $result = $describe_action->getResult();
            foreach ($result->Rule as $rule) {
                if ($rule->RuleName === \Swango\Environment::getName()) {
                    self::$rule_id = $rule->RuleId;
                    break;
                }
            }
            if (! isset(self::$rule_id) && $auto_build) {
                $builder = new CreateRulesJsonBuilder();
                $builder->addRule(\Swango\Environment::getName(), '/' . \Swango\Environment::getName(),
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
                throw new LocalRuleIsNotAvailableException();
            }
        }
        return self::$rule_id;
    }
    public static function isAvailable(bool $auto_build = true): bool {
        try {
            self::getRuleId($auto_build);
            $describe_action = new DescribeRuleAttribute();
            $result = $describe_action->getResult();
            if ($result->ListenerSync === 'on' || $result->HealthCheck === 'off') {
                if ($auto_build) {
                    $set_action = new SetRule();
                    $set_action->getResult();
                    return true;
                } else {
                    return false;
                }
            } else {
                return true;
            }
        } catch (LocalRuleIsNotAvailableException $e) {
            return false;
        }
    }
}