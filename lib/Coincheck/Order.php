<?php
namespace Coincheck;

class Order
{
    /** @var Coincheck */
    private $client;

    public function __construct(\Coincheck\Coincheck $client)
    {
        $this->client = $client;
    }

    /**
     * Create a order object with given parameters.
     * In live mode, this issues a transaction.
     *
     * @param  mixed
     * @return OederRequestCreate
     */
    public function create($params = array())
    {
        $arr = $params;
        $rawResponse = $this->client->request('post', 'api/exchange/orders', $arr);
        return $rawResponse;
    }

    /**
     * cancel a created order specified by order id.
     * Optional argument amount is to refund partially.
     *
     * @param  mixed
     * @return OrderIdRequest
     */
    public function cancel($params = array())
    {
        $arr = array( "id" => $params["id"]);
        $rawResponse = $this->client->request('delete', 'api/exchange/orders' . '/' . $arr['id'] , $arr);
        return $rawResponse;
    }

    /**
     * List charges filtered by params
     *
     * @param  mixed
     * @return OrderIdRequest
     */
    public function opens($params = array())
    {
        $arr = array();
        $rawResponse = $this->client->request('get', 'api/exchange/orders/opens', $arr);
        return $rawResponse;
    }

    /**
     * Get Order Transactions
     *
     * @param  mixed
     * @return OrderIdRequest
     */
    public function transactions($params = array())
    {
        $arr = array();
        $rawResponse = $this->client->request('get', 'api/exchange/orders/transactions', $arr);
        return $rawResponse;
    }

}
