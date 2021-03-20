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
        $config = Config::getConfig();
        if (! isset($config)) {
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