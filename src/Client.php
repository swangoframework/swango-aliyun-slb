<?php
namespace Swango\Aliyun\Slb;
use Swango\Aliyun\Slb\Exception\RequestErrorException;
class Client extends \BaseClient {
    protected const METHOD = 'GET', HOST = 'slb.aliyuncs.com';
    public function sendRequest(?Request $request = null): void {
        $this->makeClient();
        if (isset($request)) {
            $this->client->getUri()->withQuery($request->getFinalQueryParameters());
        }
        $this->sendHttpRequest();
    }
    public function getResponse() {
        try {
            $response = $this->recv();
            $body = $response->body;
            return \Json::decodeAsObject($body);
        } catch (\ApiErrorException $e) {
            throw new RequestErrorException();
        }
    }
}