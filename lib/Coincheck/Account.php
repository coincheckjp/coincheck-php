<?php
namespace Coincheck;

class Account
{
    /** @var Coincheck */
    private $client;

    public function __construct(\Coincheck\Coincheck $client)
    {
        $this->client = $client;
    }

    /**
     * Make sure a balance.
     *
     * @param  mixed
     * @return Json Array
     */
    public function balance($params = array())
    {
        $arr = array();
        $rawResponse = $this->client->request('get', 'api/accounts/balance', $arr);
        return $rawResponse;
    }

    /**
     * Make sure a leverage balance.
     *
     * @param  mixed
     * @return Json Array
     */
    public function leverage_balance($params = array())
    {
        $arr = array();
        $rawResponse = $this->client->request('get', 'api/accounts/leverage_balance', $arr);
        return $rawResponse;
    }

    /**
     * Get account information.
     *
     * @param  mixed
     * @return Json Array
     *
     * */
    public function info($params = array())
    {
        $arr = array();
        $rawResponse = $this->client->request('get', 'api/accounts/balance', $arr);
        return $rawResponse;
    }
}
