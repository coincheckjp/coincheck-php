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
        $this->client->request('borrow.create', $arr);
    }

    /**
     * Get a borrowing list.
     *
     * @param  mixed
     * @return Json Array
     */
    public function _list($params = array())
    {
        $arr = array();
        $this->client->request('borrow.list', $arr);
    }

    /**
     * Based on this id, you can repay.
     *
     * @param  mixed
     * @return Json Array
     */
    public function replay($params = array())
    {
        $arr = array( "id" => $params["id"]);
        $this->client->request('borrow.replay', $arr);
    }
}
