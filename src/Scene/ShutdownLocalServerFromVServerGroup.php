<?php
namespace Swango\Aliyun\Slb\Scene;
use Swango\Aliyun\Slb\Action\VServerGroup\BackendServer\RemoveVServerGroupBackendServers;
use Swango\Aliyun\Slb\Action\VServerGroup\Rule\DeleteRules;
use Swango\Aliyun\Slb\Config;
use Swango\Aliyun\Slb\JsonBuilder\DeleteRulesJsonBuilder;
use Swango\Aliyun\Slb\JsonBuilder\RemoveBackendServersJsonBuilder;
use Swango\Aliyun\Slb\LocalRule;
use Swango\Aliyun\Slb\LocalServer;
use Swango\Aliyun\Slb\LocalVServerGroup;
class ShutdownLocalServerFromVServerGroup {
    public static function shutdown(bool $with_clear_rule = true) {
        try {
            $group_config = \Swango\Environment::getConfig('aliyun/slb_group');
            foreach ($group_config as $config_key) {
                Config::setCurrent($config_key);
                self::__shutdown($with_clear_rule);
            }
        } catch (\Swango\Environment\Exception) {
            self::__shutdown($with_clear_rule);
        }
    }
    private static function __shutdown(bool $with_clear_rule) {
        $config = Config::getCurrent();
        if (! isset($config)) {
            return;
        }
        if (LocalVServerGroup::isAvailable(false)) {
            if (LocalServer::isAvailable(false)) {
                $builder = new RemoveBackendServersJsonBuilder();
                $builder->addServer(LocalServer::getServerId(), LocalServer::getServerPort());
                $action = new RemoveVServerGroupBackendServers($builder);
                $action->getResult();
            }

            if ($with_clear_rule && LocalRule::isAvailable(false)) {
                $builder = new DeleteRulesJsonBuilder();
                $builder->addRule(LocalRule::getRuleId());
                $action = new DeleteRules($builder);
                $action->getResult();
            }
        }
    }
}