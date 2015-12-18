<?php
namespace Coincheck;

class Withdraw
{
    /** @var Coincheck */
    private $client;

    public function __construct(\Coincheck\Coincheck $client)
    {
        $this->client = $client;
    }

    /**
     * Create a new Withdraw.
     *
     * @param  mixed
     * @return Json Array
     */
    public function create($params = array())
    {
        $arr = $params;
        $rawResponse = $this->client->request('post', 'api/withdraws', $arr);
        return $rawResponse;
    }

    /**
     * Get a withdraw list.
     *
     * @param  mixed
     * @return Json Array
     */
    public function all($params = array())
    {
        $arr = array();
        $rawResponse = $this->client->request('get', 'api/withdraws', $arr);
        return $rawResponse;
    }

    /**
     * Based on this id, you can repay.
     *
     * @param  mixed
     * @return Json Array
     */
    public function cancel($params = array())
    {
        $arr = array("id" => $params["id"]);
        $rawResponse = $this->client->request('delete', 'api/withdraws/' . $arr['id'] , $arr);
        return $rawResponse;
    }
}
