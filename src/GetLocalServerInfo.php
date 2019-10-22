<?php
namespace Swango\Aliyun\Slb\Action\BackendServer;
/**
 * get local aliyun server ip and id
 * Class GetLocalServerInfo
 * @return array
 * {
 *      "local_id":"",
 *      "local_ip":""
 * }
 */
class GetLocalServerInfo extends \BaseClient {
    public static $local_id, $local_ip;
    protected const METHOD = 'GET', HOST = '100.100.100.200', ID_PATH = '/2016-01-01/meta-data/instance-id', IP_PATH = '/2016-01-01/meta-data/private-ipv4';
    public static function getInfo() {
        if (! isset(self::$local_id)) {
            $client = new self();
            $client->client->getUri()->withPath(self::ID_PATH);
            $response = $client->sendHttpRequest()->recv();
            if ($response->getStatusCode() !== 200) {
                throw new \ApiErrorException('get server id error');
            }
            self::$local_id = $response->getBody();
        }
        if (! isset($self::$local_ip)) {
            $client = new self();
            $client->client->getUri()->withPath(self::IP_PATH);
            $response = $client->sendHttpRequest()->recv();
            if ($response->getStatusCode() !== 200) {
                throw new \ApiErrorException('get server ip error');
            }
            self::$local_ip = $response->getBody();
        }
        return [
            'local_id' => self::$local_id,
            'local_ip' => self::$local_ip
        ];
    }
}