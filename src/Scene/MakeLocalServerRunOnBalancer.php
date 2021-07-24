<?php
namespace Swango\Aliyun\Slb\Scene;
use Swango\Aliyun\Slb\Config;
use Swango\Aliyun\Slb\Exception\LocalBalancerIsNotAvailableException;
use Swango\Aliyun\Slb\Exception\LocalHTTPListenerIsNotAvailableException;
use Swango\Aliyun\Slb\Exception\LocalRuleIsNotAvailableException;
use Swango\Aliyun\Slb\Exception\LocalServerIsNotAvailableException;
use Swango\Aliyun\Slb\Exception\LocalVServerGroupIsNotAvailableException;
use Swango\Aliyun\Slb\LocalBalancer;
use Swango\Aliyun\Slb\LocalHTTPListener;
use Swango\Aliyun\Slb\LocalRule;
use Swango\Aliyun\Slb\LocalServer;
use Swango\Aliyun\Slb\LocalVServerGroup;
class MakeLocalServerRunOnBalancer {
    public static function make() {
        try {
            $group_config = \Swango\Environment::getConfig('aliyun/slb_group');
            foreach ($group_config as $config_key) {
                Config::setCurrent($config_key);
                self::__make();
            }
        } catch (\Swango\Environment\Exception) {
            self::__make();
        }
    }
    private static function __make() {
        $config = Config::getCurrent();
        if (! $config->isAvailable()) {
            return;
        }
        if (! LocalHTTPListener::isAvailable()) {
            throw new LocalHTTPListenerIsNotAvailableException();
        }
        if (! LocalBalancer::isAvailable()) {
            throw new LocalBalancerIsNotAvailableException();
        }
        if (! LocalRule::isAvailable()) {
            throw new LocalRuleIsNotAvailableException();
        }
        if (! LocalVServerGroup::isAvailable()) {
            throw new LocalVServerGroupIsNotAvailableException();
        }
        if (! LocalServer::isAvailable()) {
            throw new LocalServerIsNotAvailableException();
        }
    }
}