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
    /** @var Leverage */
    private $leverage;
    /** @var Account */
    private $account;
    /** @var Send */
    private $send;
    /** @var Deposit */
    private $deposit;
    /** @var BankAccount */
    private $bank_account;
    /** @var Withdraw */
    private $withdraw;
    /** @var Borrow */
    private $borrow;
    /** @var Transfer */
    private $transfer;

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

        /** Public API */
        $this->ticker = new Ticker($this);
        $this->trade = new Trade($this);
        $this->orderBook = new OrderBook($this);

        /** Private API */
        $this->order = new Order($this);
        $this->leverage = new Leverage($this);
        $this->account = new Account($this);
        $this->send = new Send($this);
        $this->deposit = new Deposit($this);
        $this->bank_account = new BankAccount($this);
        $this->withdraw = new Withdraw($this);
        $this->borrow = new Borrow($this);
        $this->transfer = new Transfer($this);
    }

    public function __get($key)
    {
        $accessors = array('ticker', 'trade','orderBook', 'order', 'leverage', 'account', 'send', 'deposit', 'bank_account', 'withdraw', 'borrow', 'transfer');
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
        if($method == 'get' && count($paramData) > 0) {
            $path = $path . '?';
            foreach ($paramData as $k => $v) {
                $path .= $k.'='.$v;
            }
            $paramData=array();
        }
        $this->setSignature($path, $paramData);
        $req = $this->client->createRequest($method, $path, array());
        if($method == 'post' || $method == 'delete') {
            foreach ($paramData as $k => $v) {
                $req->setPostField($k, $v);
            }
        }
        try {
            $res = $req->send();
            return $res->json();
        } catch (\Guzzle\Common\Exception\RuntimeException $e) {
            echo $e->getResponse()->getBody();
        }
    }
}
