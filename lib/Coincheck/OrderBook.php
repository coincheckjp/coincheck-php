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
        $this->client->request('orderBook', 'api/order_books', $arr);
    }

}
