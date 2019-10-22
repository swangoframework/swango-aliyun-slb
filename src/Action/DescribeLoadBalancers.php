<?php
namespace Swango\Aliyun\Slb\Action;
use Swango\Aliyun\Slb\Client;
use Swango\Aliyun\Slb\Request;
class DescribeLoadBalancers {
    const ACTION = 'DescribeLoadBalancers';
    private $client, $request;
    public function __construct() {
        $config = \Swango\Environment::getConfig('aliyun/slb');
        $this->client = new Client();
        $this->request = new Request(self::ACTION);
        $this->request->setRegionId($config['regent_id']);
    }
    public function getResult() {
        $this->client->sendRequest($this->request);
        return $this->client->getResponse();
    }
}