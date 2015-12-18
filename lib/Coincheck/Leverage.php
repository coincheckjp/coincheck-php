<?php
namespace Coincheck;

class Leverage
{
    /** @var Coincheck */
    private $client;

    public function __construct(\Coincheck\Coincheck $client)
    {
        $this->client = $client;
    }


    /**
     * Get a leverage positions list.
     *
     * @param  mixed
     * @return Json Array
     */
    public function positions($params = array())
    {
        $arr = $params;
        $rawResponse = $this->client->request('get', 'api/exchange/leverage/positions', $arr);
        return $rawResponse;
    }
}
