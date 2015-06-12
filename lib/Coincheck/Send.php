<?php
namespace Coincheck;

class Send
{
    /** @var Coincheck */
    private $client;

    public function __construct(\Coincheck\Coincheck $client)
    {
        $this->client = $client;
    }

    /**
     * Sending Bitcoin to specified Bitcoin addres.
     *
     * @param  mixed
     * @return Json Array
     */
    public function create($params = array())
    {
        $arr = array(
            "address" => $params["address"],
            "amount" => $params["amount"]
        );
        $rawResponse = $this->client->request('post', 'api/send_money', $arr);
        return $rawResponse;
    }
}
