<?php
namespace Swango\Aliyun\Slb\Action;
use Swango\Aliyun\Slb\Client;
use Swango\Aliyun\Slb\Request;
abstract class BaseAction {
    protected $client, $request, $config;
    const ACTION = null;
    public function __construct() {
        $this->config = \Swango\Environment::getConfig('aliyun/slb');
        $this->client = new Client();
        $this->request = new Request(get_called_class()::ACTION ?? basename(str_replace('\\', '/', get_called_class())),
            $this->config['access_key_id'], $this->config['access_key_secret'], $this->config['regent_id']);
    }
    public function isHTTPS(): bool {
        $protocol = $this->config['balancer_listener_protocol'] ?? 'http';
        return $protocol === 'https';
    }
    public function isHTTP(): bool {
        $protocol = $this->config['balancer_listener_protocol'] ?? 'http';
        return $protocol === 'http';
    }
    public function getResult() {
        $this->client->sendRequest($this->request);
        return $this->client->getResponse();
    }
}