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

```php
require "vendor/autoload.php";
use Coincheck\Coincheck;
$coincheck= new Coincheck('ACCESS_KEY', 'API_SECRET');

/** Public API */

$coincheck->ticker->all();
$coincheck->trade->all();
$coincheck->orderBook->all();

/** Private API */

$coincheck->order->create(array(
    "rate" => "28500",
    "amount" => "0.00508771",
    "order_type" => "buy",
    "pair" => "btc_jpy"
));
$coincheck->order->opens();
$coincheck->order->transactions();
$coincheck->order->cancel(array( "id" => 2953613));

$coincheck->account->balance();
$coincheck->account->info(array());

$coincheck->send->create(array(
    "address" => '1Gp9MCp7FWqNgaUWdiUiRPjGqNVdqug2hY',
    "amount" => '0.0002'
));

$coincheck->borrow->create(array(
    "amount" => "0.01",
    "currency" => "BTC"
));
$coincheck->borrow->matches();
$coincheck->borrow->repay(array("id" => "1135"));

$coincheck->lend->create(array(
    "amount" => "0.01",
    "currency" => "BTC"
));
$coincheck->lend->cancel(array("id" => "1363"));
$coincheck->lend->pendings();
$coincheck->lend->matches();

```


## Dependencies

* [guzzle](http://docs.guzzlephp.org/en/latest/) as a HTTP client

## License
MIT

