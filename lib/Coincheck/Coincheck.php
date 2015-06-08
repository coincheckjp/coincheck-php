<?php
namespace Coincheck;

use Guzzle\Common\Event as GuzzleEvent;
use Guzzle\Service\Client as GuzzleClient;

class Coincheck
{
    /** @var GuzzleClient */
    private $client;

    /** @var Order */
    private $order;
    /** @var Lending */
    private $lending;
    /** @var Account */
    private $account;
    /** @var MarginTrading */
    private $marginTrading;

    /**
     * @param array $options API options
     */
    public function __construct($accessKey, $apiSecret, $options = array())
    {
        $apiBase = 'https://coincheck.jp/';
        $this->client = new GuzzleClient($apiBase);
        $this->client->setDefaultOption('headers/Content-Type', "application/json");
        $this->client->setDefaultOption('headers/ACCESS-KEY', $accessKey);

        $this->order = new Order($this);
        $this->send = new Send($this);
        $this->lending = new Lending($this);
        $this->account = new Account($this);
        $this->marginTrading = new MarginTrading($this);
    }

    public function __get($key)
    {
        $accessors = array('order', 'lending', 'account', 'event', 'marginTrading');
        if (in_array($key, $accessors) && property_exists($this, $key)) {
            return $this->{$key};
        } else {
            throw new \Exception('Unknown accessor ' . $key);
        }
    }

    public function __set($key, $value)
    {
//        throw new \Exception($key . ' is not able to override');
    }

    public function get_signature($url, $secret, $arr = array())
    {
        $nonce = time();
        $message = $nonce.$url.http_build_query($arr);
        $signature = hash_hmac("sha256", $message, $secret);
    }

    /**
     * Dispatch API request
     *
     * @param string $method    HTTP method
     * @param string $path      Target path relative to base_url option value
     * @param object $paramData Request data
     *
     * @return mixed Response object
     */
    public function request($method, $path, $paramData)
    {
        //$this->client->setDefaultOption('headers/ACCESS-NONCE', "");
        //$this->client->setDefaultOption('headers/ACCESS-SIGNATURE', "");
        $req = $this->client->createRequest($method, $path, array());
        $query = $req->getQuery();
        //foreach ($paramData->queryParams() as $k => $v) {
        //    if ($v === null) continue;
        //    $query->add($k, (is_bool($v)) ? ($v ? 'true' : 'false') : $v);
        //}
        try {
            $res = $req->send();
            return $res->json();
        } catch (\Guzzle\Common\Exception\RuntimeException $e) {
            throw var_dump($e);
        }
    }

}

