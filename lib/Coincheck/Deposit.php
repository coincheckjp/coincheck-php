<?php
namespace Coincheck;

class Deposit
{
    /** @var Coincheck */
    private $client;

    public function __construct(\Coincheck\Coincheck $client)
    {
        $this->client = $client;
    }

    /**
     * You Get Deposit history
     *
     * @param  mixed
     * @return Json Array
     */
    public function all($params = array())
    {
        $arr = array(
            "currency" => $params["currency"]
        );
        $rawResponse = $this->client->request('get', 'api/deposit_money', $arr);
        return $rawResponse;
    }

    /**
     * Deposit Bitcoin Faster
     *
     * @param  mixed
     * @return Json Array
     */
    public function fast($params = array())
    {
        $arr = array(
            "id" => $params["id"]
        );
        $rawResponse = $this->client->request('post', 'api/deposit_money/' . $arr["id"] . "/fast", $arr);
        return $rawResponse;
    }
}
