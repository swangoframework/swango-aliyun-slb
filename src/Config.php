<?php
namespace Swango\Aliyun\Slb;
use Swango\Environment\Exception;
/**
 * @property  string $access_key_id
 * @property  string $access_key_secret
 * @property  string $regent_id
 * @property  string $balancer_id
 * @property  ?string $balancer_listener_port
 * @property  ?string $balancer_listener_protocol
 * @property  ?string $balancer_listener_cert_id
 * @property  ?string $rule_domain
 * @property  ?string $rule_path
 *
 * Class Config
 * @package Swango\Aliyun\Slb
 */
class Config {
    private array $content;
    public string $rule_id;
    public string $server_id;
    public string $group_id;
    public ?array $group_backend_servers;
    private function __construct(string $config_key) {
        try {
            $this->content = \Swango\Environment::getConfig($config_key);
        } catch (Exception $e) {
        }
    }
    public function isAvailable(): bool {
        return isset($this->content);
    }
    public function __get(string $key) {
        return $this->content->{$key} ?? null;
    }
    public function __isset(string $key) {
        return isset($this->data->{$key});
    }
    public static function setCurrent(string $config_key): void {
        \Context::set('slb_config_key', $config_key);
    }
    public static function getCurrent(): self {
        $config_key = \Context::get('slb_config_key') ?? 'aliyun/slb';
        $instance = \Context::hGet('slb_config_arr', $config_key);
        if (! isset($instance)) {
            $instance = new self($config_key);
            \Context::hSet('slb_config_arr', $config_key, $instance);
        }
        return $instance;
    }
    public function isHTTP(): bool {
        $protocol = $this->content['balancer_listener_protocol'] ?? 'http';
        return $protocol === 'http';
    }
    public function isHTTPS(): bool {
        $protocol = $this->content['balancer_listener_protocol'] ?? 'http';
        return $protocol === 'https';
    }
    public function isDomainRule(): bool {
        return isset($this->content['rule_domain']);
    }
}