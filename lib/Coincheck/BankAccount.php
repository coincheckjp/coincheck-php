<?php
namespace Coincheck;

class BankAccount
{
    /** @var Coincheck */
    private $client;

    public function __construct(\Coincheck\Coincheck $client)
    {
        $this->client = $client;
    }

    /**
     * Create a new BankAccount.
     *
     * @param  mixed
     * @return Json Array
     */
    public function create($params = array())
    {
        $arr = array(
            "bank_name" => $params["bank_name"],
            "branch_name" => $params["branch_name"],
            "bank_account_type" => $params["bank_account_type"],
            "number" => $params["number"],
            "name" => $params["name"]
        );
        $rawResponse = $this->client->request('post', 'api/bank_accounts', $arr);
        return $rawResponse;
    }

    /**
     * Get account information.
     *
     * @param  mixed
     * @return Json Array
     *
     * */
    public function all($params = array())
    {
        $arr = array();
        $rawResponse = $this->client->request('get', 'api/bank_accounts', $arr);
        return $rawResponse;
    }

    /**
     * Delete a BankAccount.
     *
     * @param  mixed
     * @return Json Array
     */
    public function delete($params = array())
    {
        $arr = array( "id" => $params["id"] );
        $rawResponse = $this->client->request('delete', 'api/bank_accounts/' . $arr["id"], $arr);
        return $rawResponse;
    }
}
