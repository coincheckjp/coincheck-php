# coincheck 

coincheck
The easiest Bitcoin Exchange in Japan
https://coincheck.jp/


## Requirements

PHP 5.4+

## Installation

Add the following to `composer.json`.

```json
{
    "require": {
            "coincheck/coincheck"
        }
}
```

## Usage

```
require "vendor/autoload.php";
use Coincheck\Coincheck;
$coincheck= new Coincheck('API_SECRET');

// Order
$coincheck->order->create(array(
      "rate"=> "30010.0",
      "amount"=> "1.3",
      "order_type"=> "sell",
      "pair"=> "btc_jpy"
      ));
$coincheck->order->cancel(array(
   "id"=> "3333",
));
$coincheck->order->opens();
$coincheck->order->transactions();

// Send
$coincheck->send->create(array(
      "address": "1v6zFvyNPgdRvhUufkRoTtgyiw1xigncc",
      "amount": "1.5"
      ));

// Account
$coincheck->account->balance();
$coincheck->account->info();

// Lending
$coincheck->lending->borrows->create(array(
      "amount": "1.3",
      "currency": "BTC"
      ));
$coincheck->lending->borrows->list();
$coincheck->lending->borrows->repay(array(
      "id": "222222"
      ));
$coincheck->lending->lend->create(array(
      "amount": "1.3",
      "currency": "BTC"
      ));
$coincheck->lending->lend->pendings();
$coincheck->lending->lend->cancel(array(
      "id": "222222"
      ));
$coincheck->lending->lend->matches();
```


## Dependencies

## License
MIT

