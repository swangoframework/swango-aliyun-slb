<?php
namespace Swango\Aliyun\Slb\Action;
use Swango\Aliyun\Slb\Client;
use Swango\Aliyun\Slb\Config;
use Swango\Aliyun\Slb\Request;
abstract class BaseAction {
    protected $client, $request, $config;
    public function __construct() {
        $this->config = Config::getConfig();
        $this->client = new Client();
        $this->request = new Request(get_called_class()::ACTION ?? basename(str_replace('\\', '/', get_called_class())),
            $this->config['access_key_id'], $this->config['access_key_secret'], $this->config['regent_id']);
    }
    public function getResult() {
        $this->client->sendRequest($this->request);
        return $this->client->getResponse();
    }
}