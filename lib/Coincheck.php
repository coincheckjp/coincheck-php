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
    public function __construct($authToken, $options = array())
    {
        $apiBase = 'https://coincheck.jp/';
        $this->client = new GuzzleClient($apiBase);
        $this->client->setDefaultOption('headers/Authorization', 'Bearer ' . $authToken);
        $this->client->setDefaultOption('headers/Content-Type', "application/json");
        $this->client->setDefaultOption('headers/Accept', "application/json");
        $this->client->setDefaultOption('headers/Accept-Language', "en");
        $this->client->getEventDispatcher()->addListener('request.error', array($this, 'onRequestError'));
        $this->client->getEventDispatcher()->addListener('request.exception', array($this, 'onRequestException'));
        $this->order = new Order($this);
        $this->lending = new Lending($this);
        $this->account = new Account($this);
        $this->marginTrading = new MarginTrading($this);
    }
}
