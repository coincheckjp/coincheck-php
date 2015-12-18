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
        "coincheck/coincheck": "1.0.2"
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

# 新規注文
# "buy" 指値注文 現物取引 買い
# "sell" 指値注文 現物取引 売り
# "market_buy" 成行注文 現物取引 買い
# "market_sell" 成行注文 現物取引 売り
# "leverage_buy" 指値注文 レバレッジ取引新規 買い
# "leverage_sell" 指値注文 レバレッジ取引新規 売り
# "close_long" 指値注文 レバレッジ取引決済 売り
# "close_short" 指値注文 レバレッジ取引決済 買い
$coincheck->order->create(array(
    "rate" => "28500",
    "amount" => "0.00508771",
    "order_type" => "buy",
    "pair" => "btc_jpy"
));
# 未決済の注文一覧
$coincheck->order->opens();
# 注文のキャンセル
$coincheck->order->cancel(array("id"=>2953613));
# 取引履歴
$coincheck->order->transactions();
# ポジション一覧
$coincheck->leverage->positions();
# 残高
$coincheck->account->balance();
# レバレッジアカウントの残高
$coincheck->account->leverage_balance();
# アカウント情報
$coincheck->account->info();
# ビットコインの送金
$coincheck->send->create(array(
    "address" => '1Gp9MCp7FWqNgaUWdiUiRPjGqNVdqug2hY',
    "amount" => '0.0002'
));
# ビットコインの送金履歴
$coincheck->send->all(array("currency"=>"BTC"));
# ビットコインの受け取り履歴
$coincheck->deposit->all(array("currency"=>"BTC"));
# ビットコインの高速入金
$coincheck->deposit->fast(array("id"=> 2222));
# 銀行口座一覧
$coincheck->bank_account->all();
# 銀行口座の登録
$coincheck->bank_account->create(array(
    "bank_name" => "住信SBIネット",
    "branch_name" => "ミカン",
    "bank_account_type" => "futu",
    "number" => "123456",
    "name" => "ヤマモト タロウ"
));
# 銀行口座の削除
$coincheck->bank_account->delete();
# 出金履歴
$coincheck->withdraw->all();
# 出金申請の作成
$coincheck->withdraw->create(
    "bank_account_id" => 2222,
    "amount" => 50000,
    "currency" => "JPY",
    "is_fast" => false
));
# 出金申請のキャンセル
$coincheck->withdraw->cancel();
# 借入申請
$coincheck->borrow->create(array(
    "amount" => "0.01",
    "currency" => "BTC"
));
# 借入中一覧
$coincheck->borrow->matches();
# 返済
$coincheck->borrow->repay(array("id" => "1135"));
# レバレッジアカウントへの振替
$coincheck->transfer->to_leverage(array(
    "amount" => 100,
    "currency" => "JPY"
));
# レバレッジアカウントからの振替
$coincheck->transfer->from_leverage(array(
    "amount" => 100,
    "currency" => "JPY"
));

```


## Dependencies

* [guzzle](http://docs.guzzlephp.org/en/latest/) as a HTTP client

## License
MIT

