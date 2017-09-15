<?php
namespace Coincheck;

class Rate
{
    /** @var Coincheck */
    private $client;

    public function __construct(\Coincheck\Coincheck $client)
    {
        $this->client = $client;
    }

    /**
     * 販売所のレートを取得します。
     *
     * @param  mixed
     * @return Json Array
     */
    public function pair($pair = 'btc_jpy')
    {
        $arr = array();
        $rawResponse = $this->client->request('get', 'api/rate/' . $pair, $arr);
        return $rawResponse;
    }

}
