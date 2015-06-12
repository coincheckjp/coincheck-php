<?php
namespace Coincheck;

use Guzzle\Common\Event as GuzzleEvent;
use Guzzle\Service\Client as GuzzleClient;
use Guzzle\Service\Description\ServiceDescription;

class Coincheck
{
    /** @var GuzzleClient */
    private $client;

    public $apiBase;
    public $accessKey;
    public $secretKey;

    /** @var Ticker */
    private $ticker;
    /** @var $Trade */
    private $trade;
    /** @var OrderBooks */
    private $orderBook;

    /** @var Order */
    private $order;
    /** @var Send */
    private $send;
    /** @var Borrow */
    private $borrow;
    /** @var Lend */
    private $lend;
    /** @var Account */
    private $account;

    /**
     * @param array $options API options
     */
    public function __construct($accessKey, $secretKey, $options = array())
    {
        $this->apiBase = 'https://coincheck.jp/';
        $this->accessKey = $accessKey;
        $this->secretKey = $secretKey;

        $this->client = new GuzzleClient($this->apiBase);
        $this->client->setDefaultOption('headers/Content-Type', "application/json");
        $this->client->setDefaultOption('headers/ACCESS-KEY', $this->accessKey);
        //$description = ServiceDescription::factory(__DIR__ . "/Resource/service_descriptions/concheck.json");
        //$this->client->setDescription($description);

        /** Public API */
        $this->ticker = new Ticker($this);
        $this->trade = new Trade($this);
        $this->orderBook = new OrderBook($this);

        /** Private API */
        $this->order = new Order($this);
        $this->send = new Send($this);
        $this->lend = new Lend($this);
        $this->borrow = new Borrow($this);
        $this->account = new Account($this);
    }

    public function __get($key)
    {
        $accessors = array('ticker', 'trade','orderBook', 'order', 'lend', 'borrow', 'send', 'account');
        if (in_array($key, $accessors) && property_exists($this, $key)) {
            return $this->{$key};
        } else {
            throw new \Exception('Unknown accessor ' . $key);
        }
    }

    public function __set($key, $value)
    {
        throw new \Exception($key . ' is not able to override');
    }

    public function setSignature($path, $arr = array())
    {
        $nonce = time();
        $url = $this->apiBase.$path;
        $message = $nonce.$url.http_build_query($arr);
        $signature = hash_hmac("sha256", $message, $this->secretKey);
        $this->client->setDefaultOption('headers/ACCESS-NONCE', $nonce);
        $this->client->setDefaultOption('headers/ACCESS-SIGNATURE', $signature);
    }

    /**
     * Dispatch API request
     *
     * @param string $operation Target action
     * @param object $paramData Request data
     *
     */
    public function request($method, $path, $paramData)
    {
        $this->setSignature($path, $paramData);
        $req = $this->client->createRequest($method, $path, array());
        foreach ($paramData as $k => $v) {
            $req->setPostField($k, $v);
        }
        $query = $req->getQuery();
        try {
            $res = $req->send();
            return $res->json();
        } catch (\Guzzle\Common\Exception\RuntimeException $e) {
            echo $e->getResponse()->getBody();
        }
    }
}
