<?php
namespace Swango\Aliyun\Slb;
use Swango\Environment\Exception;
class Config {
    private static self $instance;
    private ?array $config;
    private function __construct() {
        try {
            $this->config = \Swango\Environment::getConfig('aliyun/slb');
        } catch (Exception $e) {
            $this->config = null;
        }
    }
    public static function getConfig(): ?array {
        return self::getInstance()->config;
    }
    public static function getInstance(): self {
        if (! isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    public static function isHTTP(): bool {
        $instance = self::getInstance();
        $protocol = $instance->config['balancer_listener_protocol'] ?? 'http';
        return $protocol === 'http';
    }
    public static function isHTTPS(): bool {
        $instance = self::getInstance();
        $protocol = $instance->config['balancer_listener_protocol'] ?? 'http';
        return $protocol === 'https';
    }
    public static function isDomainRule(): bool {
        return isset(self::getInstance()->config['rule_domain']);
    }
}