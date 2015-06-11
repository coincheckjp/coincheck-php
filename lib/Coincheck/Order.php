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
        $arr = array(
            "rate" => $params["rate"],
            "amount" => $params["amount"],
            "order_type" => $params["order_type"],
            "pair" => $params["pair"]
        );
        $this->client->request('order.create', $arr);
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
        $this->client->request('order.cancel', $arr);
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
        $this->client->request('order.opens', 'api/exchange/orders/opens', $arr);
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
        $this->client->request('order.transactions', 'api/exchange/orders/transactions', $arr);
    }

}
