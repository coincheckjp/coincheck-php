<?php

require __DIR__ . "/../vendor/autoload.php";
require dirname(__FILE__) . '/../lib/Coincheck/Coincheck.php';

use Coincheck\Coincheck;
$coincheck = new Coincheck('ACCESS_KEY', 'API_SECRET');


///** Public API */

$res = $coincheck->ticker->all();
$res = $coincheck->trade->all();
$res = $coincheck->orderBook->all();
echo json_encode($res);

/** Private API */
/*
$res = $coincheck->order->create(array(
    "rate" => "28500",
    "amount" => "0.00508771",
    "order_type" => "buy",
    "pair" => "btc_jpy"
));
$res = $coincheck->order->opens();
$res = $coincheck->order->transactions();
$res = $coincheck->order->cancel(array( "id" => '2995323'));
$res = $coincheck->account->balance();
$res = $coincheck->account->info(array());
$res = $coincheck->send->create(array(
    "address" => '1Gp9MCp7FWqNgaUWdiUiRPjGqNVdqug2hY',
    "amount" => '0.0002'
));
$coincheck->send->all();

$coincheck->deposit->all();

$res = $coincheck->borrow->create(array(
    "amount" => "0.01",
    "currency" => "BTC"
));
$res = $coincheck->borrow->matches();
$res = $coincheck->borrow->repay(array("id" => "1169"));
$res = $coincheck->lend->create(array(
    "amount" => "0.01",
    "currency" => "BTC"
));
$res = $coincheck->lend->create(array(
    "amount" => "0.01",
    "currency" => "BTC"
));
$res = $coincheck->lend->matches();
$res = $coincheck->lend->pendings();
$res = $coincheck->lend->cancel(array("id" => "1387"));
 */
