<?php
namespace Swango\Aliyun\Slb;
use Swango\Aliyun\Sts\Auth\Credential;
use Swango\Aliyun\Sts\Auth\ShaHmac1Signer;
use Swango\Aliyun\Sts\Auth\ISigner;
use Swango\Aliyun\Sts\RpcAcsRequest;
/**
 * @property Credential $credential
 * @property ISigner $signer
 */
class Request extends RpcAcsRequest {
    private $credential, $signer;
    function __construct($action_name) {
        parent::__construct('Slb', '2014-05-26', $action_name);
        $this->loadConfig();
    }
    private function loadConfig() {
        $config = \Swango\Environment::getFrameworkConfig('aliyun_slb');
        $this->credential = new Credential($config['access_key_id'], $config['access_key_secret']);
        $this->signer = new ShaHmac1Signer();
    }
    public function getFinalQueryParameters(): array {
        return parent::getFinalQuery($this->signer, $this->credential);
    }
    public function setQueryParameters(array $params) {
        $this->queryParameters = $params;
    }
    public function setQueryParameter(string $key, $value) {
        $this->queryParameters[$key] = $value;
    }
}