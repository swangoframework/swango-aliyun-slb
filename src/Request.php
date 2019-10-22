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
    private $credential, $signer, $access_key_id, $access_key_secret;
    function __construct($action_name, $access_key_id, $access_key_secret, $regent_id) {
        parent::__construct('Slb', '2014-05-15', $action_name);
        $this->access_key_id = $access_key_id;
        $this->access_key_secret = $access_key_secret;
        $this->setRegionId($regent_id);
        $this->load();
    }
    private function load() {
        $this->credential = new Credential($this->access_key_id, $this->access_key_secret);
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