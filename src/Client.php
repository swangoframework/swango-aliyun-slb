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
        $response = $this->recv();
        $responseCode = $response->getStatusCode();
        $resBody = $response->body;
        if ($responseCode === 200) {
            return $resBody;
        } else {
            throw new RequestErrorException($responseCode, $resBody);
        }
    }
}