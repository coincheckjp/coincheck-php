<?php
namespace Coincheck;

class OrderBook
{
    /** @var Coincheck */
    private $client;

    public function __construct(\Coincheck\Coincheck $client)
    {
        $this->client = $client;
    }

    /**
     * 板情報を取得できます。
     *
     * @param  mixed
     * @return Json Array
     */
    public function all($params = array())
    {
        $arr = array();
        $rawResponse = $this->client->request('get', 'api/order_books', $arr);
        return $rawResponse;
    }

}
