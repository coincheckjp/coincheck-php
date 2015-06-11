<?php
namespace Coincheck;

class Lend
{
    /** @var Coincheck */
    private $client;

    public function __construct(\Coincheck\Coincheck $client)
    {
        $this->client = $client;
    }

    /**
     * Create a new lend.
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
        $this->client->request('lend.create', 'api/lending/lend', $arr);
    }

    /**
     * Get an uncontracted lending list.
     *
     * @param  mixed
     * @return Json Array
     */
    public function pendings($params = array())
    {
        $arr = array();
        $this->client->request('lend.pendings', 'api/lending/lends', $arr);
    }

    /**
     * Cancel uncontracted lendings.
     *
     * @param  mixed
     * @return Json Array
     */
    public function cancel($params = array())
    {
        $arr = array( "id" => $params["id"]);
        $this->client->request('lend.cancel', 'api/lending/lend/'.$arr['id'].'/cancel', $arr);
    }

    /**
     * get a lending list.
     *
     * @param  mixed
     * @return Json Array
     */
    public function matches($params = array())
    {
        $arr = array();
        $this->client->request('lend.matches', 'api/lending/lends/matches', $arr);
    }
}
