<?php
namespace Coincheck;

class Borrow
{
    /** @var Coincheck */
    private $client;

    public function __construct(\Coincheck\Coincheck $client)
    {
        $this->client = $client;
    }

    /**
     * Create a new Borrow.
     *
     * @param  mixed
     * @return Json Array
     */
    public function create($params = array())
    {
        $arr = array(
            "amount" => $params["amount"],
            "currency" => $params["currency"]
        );
        $rawResponse = $this->client->request('post', 'api/lending/borrows', $arr);
        return $rawResponse;
    }

    /**
     * Get a borrowing list.
     *
     * @param  mixed
     * @return Json Array
     */
    public function matches($params = array())
    {
        $arr = array();
        $rawResponse = $this->client->request('get', 'api/lending/borrows/matches', $arr);
        return $rawResponse;
    }

    /**
     * Based on this id, you can repay.
     *
     * @param  mixed
     * @return Json Array
     */
    public function repay($params = array())
    {
        $arr = array( "id" => $params["id"]);
        $rawResponse = $this->client->request('post', 'api/lending/borrows/' . $arr['id'] . '/repay', $arr);
        return $rawResponse;
    }
}
