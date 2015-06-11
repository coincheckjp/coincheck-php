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
        $rawResponse = $this->client->request('lend.create', $arr);
        return $rawResponse;
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
        $rawResponse = $this->client->request('lend.pendings', $arr);
        return $rawResponse;
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
        $rawResponse = $this->client->request('lend.cancel', $arr);
        return $rawResponse;
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
        $rawResponse = $this->client->request('lend.matches', $arr);
        return $rawResponse;
    }
}
