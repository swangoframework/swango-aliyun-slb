<?php
namespace Swango\Aliyun\Slb\Action;
use Swango\Aliyun\Slb\Client;
use Swango\Aliyun\Slb\Request;
class DescribeLoadBalancers {
    const ACTION = 'DescribeLoadBalancers';
    private $client, $request;
    public function __construct() {
        $this->client = new Client();
        $this->request = new Request(self::ACTION);
    }
    public function loadConfig() {
        $config = \Swango\Environment::getFrameworkConfig('aliyun_slb');
        $this->request->setQueryParameter('RegionId', $config['region_id']);
    }
    public function getResult() {
        $this->client->sendRequest($this->request);
        $response = $this->client->getResponse();
    }
}