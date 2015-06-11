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
        $this->client->request('borrow.create', 'api/lending/borrows', $arr);
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
        $this->client->request('borrow.matches', 'api/lending/borrows/matches',  $arr);
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
        $this->client->request('borrow.repay','api/lending/borrows/'.$arr['id'].'/repay',  $arr);
    }
}
