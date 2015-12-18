<?php
namespace Coincheck;

class Transfer
{
    /** @var Coincheck */
    private $client;

    public function __construct(\Coincheck\Coincheck $client)
    {
        $this->client = $client;
    }

    /**
     * Transfer Balance to Leverage.
     *
     * @param  mixed
     * @return Json Array
     */
    public function to_leverage($params = array())
    {
        $arr = array(
            "amount" => $params["amount"],
            "currency" => $params["currency"]
        );
        $rawResponse = $this->client->request('post', 'api/exchange/transfers/to_leverage', $arr);
        return $rawResponse;
    }

    /**
     * Transfer Balance from Leverage.
     *
     * @param  mixed
     * @return Json Array
     */
    public function from_leverage($params = array())
    {
        $arr = array(
            "amount" => $params["amount"],
            "currency" => $params["currency"]
        );
        $rawResponse = $this->client->request('post', 'api/exchange/transfers/from_leverage', $arr);
        return $rawResponse;
    }

}
