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
        $this->client->request('account.balance', 'api/accounts/balance', $arr);
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
        $this->client->request('account.info', 'api/accounts/balance', $arr);
    }
}
