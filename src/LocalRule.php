<?php
namespace Swango\Aliyun\Slb;
use Swango\Aliyun\Slb\Action\VServerGroup\Listener\DescribeLoadBalancerHTTPListenerAttribute;
use Swango\Aliyun\Slb\Action\VServerGroup\Listener\DescribeLoadBalancerHTTPSListenerAttribute;
use Swango\Aliyun\Slb\Action\VServerGroup\Rule\CreateRules;
use Swango\Aliyun\Slb\Action\VServerGroup\Rule\DescribeRuleAttribute;
use Swango\Aliyun\Slb\Action\VServerGroup\Rule\SetRule;
use Swango\Aliyun\Slb\Exception\LocalRuleIsNotAvailableException;
use Swango\Aliyun\Slb\JsonBuilder\CreateRulesJsonBuilder;
class LocalRule {
    public static function getRuleId(bool $auto_build = true) {
        $config = Config::getCurrent();
        if (! isset($config->rule_id)) {
            if ($config->isHTTPS()) {
                $describe_action = new DescribeLoadBalancerHTTPSListenerAttribute();
            } else {
                $describe_action = new DescribeLoadBalancerHTTPListenerAttribute();
            }
            $result = $describe_action->getResult();

            $config_path = $config->rule_path ?? null;
            $config_path = ($config_path === '/' || $config_path === '') ? null : $config_path;
            $config_domain = $config->rule_domain ?? null;
            foreach ($result->Rule as $rule) {
                $rule_path = $rule->Url ?? null;
                $rule_domain = $rule->Domain ?? null;
                if ($rule->RuleName === \Swango\Environment::getName() && $config_domain ===$rule_domain &&
                    $rule_path === $config_path) {
                    $config->rule_id = $rule->RuleId;
                    break;
                }
            }
            if (! isset($config->rule_id) && $auto_build) {
                $builder = new CreateRulesJsonBuilder();
                if ($config->isDomainRule()) {
                    $builder->addRule(\Swango\Environment::getName(), $config->rule_domain, $config->rule_path ?? null,
                        LocalVServerGroup::getGroupId());
                } else {
                    $builder->addRule(\Swango\Environment::getName(), null,
                        $config->rule_path ?? ('/' . \Swango\Environment::getName()), LocalVServerGroup::getGroupId());
                }
                $create_action = new CreateRules($builder);
                $rules = $create_action->getResult();
                foreach ($rules as $rule) {
                    if ($rule->RuleName === \Swango\Environment::getName()) {
                        $config->rule_id = $rule->RuleId;
                        break;
                    }
                }
            }
            if (! isset($config->rule_id)) {
                throw new LocalRuleIsNotAvailableException();
            }
        }
        return $config->rule_id;
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