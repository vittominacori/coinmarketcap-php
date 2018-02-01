# CoinMarketCap for PHP

A PHP wrapper for [CoinMarketCap](https://coinmarketcap.com/api/) APIs

## Install

```
composer require vittominacori/coinmarketcap-php
```


## Usage

### Prepare requirements

```php
require __DIR__ . '/vendor/autoload.php';

use CoinMarketCap\Market;
```

### Create client

```php
$coinmarketcap = new Market();
```

### Call APIs

#### Ticker

Optional parameters:
+ (int) start - return results from rank [start] and above
+ (int) limit - return a maximum of [limit] results (default is 100, use 0 to return all results)
+ (string) convert - return price, 24h volume, and market cap in terms of another currency. Valid values are: 
"AUD", "BRL", "CAD", "CHF", "CLP", "CNY", "CZK", "DKK", "EUR", "GBP", "HKD", "HUF", "IDR", "ILS", "INR", "JPY", "KRW", "MXN", "MYR", "NOK", "NZD", "PHP", "PKR", "PLN", "RUB", "SEK", "SGD", "THB", "TRY", "TWD", "ZAR"

```php
$coinmarketcap->getTicker(['convert' => 'EUR', 'start' => 10, 'limit' => 10]);
```

result: 

```json
[
  {
    "id": "iota",
    "name": "IOTA",
    "symbol": "MIOTA",
    "rank": "11",
    "price_usd": "2.19728",
    "price_btc": "0.00022294",
    "24h_volume_usd": "43617700.0",
    "market_cap_usd": "6107406300.0",
    "available_supply": "2779530283.0",
    "total_supply": "2779530283.0",
    "max_supply": "2779530283.0",
    "percent_change_1h": "-3.5",
    "percent_change_24h": "-4.57",
    "percent_change_7d": "-11.5",
    "last_updated": "1517474355",
    "price_eur": "1.7689070803",
    "24h_volume_eur": "35114167.6788",
    "market_cap_eur": "4916730798.0"
  },
  {
    "id": "dash",
    "name": "Dash",
    "symbol": "DASH",
    "rank": "12",
    "price_usd": "676.524",
    "price_btc": "0.0686426",
    "24h_volume_usd": "93164800.0",
    "market_cap_usd": "5312450962.0",
    "available_supply": "7852568.0",
    "total_supply": "7852568.0",
    "max_supply": "18900000.0",
    "percent_change_1h": "-2.73",
    "percent_change_24h": "-1.54",
    "percent_change_7d": "-15.5",
    "last_updated": "1517474342",
    "price_eur": "544.631587056",
    "24h_volume_eur": "75001763.2512",
    "market_cap_eur": "4276756772.0"
  },
  ...
]
```


#### Ticker (Specific Currency)

Optional parameters:
+ (string) convert - return price, 24h volume, and market cap in terms of another currency. Valid values are: 
"AUD", "BRL", "CAD", "CHF", "CLP", "CNY", "CZK", "DKK", "EUR", "GBP", "HKD", "HUF", "IDR", "ILS", "INR", "JPY", "KRW", "MXN", "MYR", "NOK", "NZD", "PHP", "PKR", "PLN", "RUB", "SEK", "SGD", "THB", "TRY", "TWD", "ZAR"

```php
$coinmarketcap->getTickerById('bitcoin', ['convert' => 'EUR']);
```

result: 

```json
[
  {
    "id": "bitcoin",
    "name": "Bitcoin",
    "symbol": "BTC",
    "rank": "1",
    "price_usd": "9997.51",
    "price_btc": "1.0",
    "24h_volume_usd": "7058590000.0",
    "market_cap_usd": "168341442541",
    "available_supply": "16838337.0",
    "total_supply": "16838337.0",
    "max_supply": "21000000.0",
    "percent_change_1h": "-1.74",
    "percent_change_24h": "-2.16",
    "percent_change_7d": "-12.85",
    "last_updated": "1517474067",
    "price_eur": "8048.43544044",
    "24h_volume_eur": "5682475527.96",
    "market_cap_eur": "135522268269"
  }
]
```


#### Global Data

Optional parameters:
+ (string) convert - return 24h volume, and market cap in terms of another currency. Valid values are: 
"AUD", "BRL", "CAD", "CHF", "CLP", "CNY", "CZK", "DKK", "EUR", "GBP", "HKD", "HUF", "IDR", "ILS", "INR", "JPY", "KRW", "MXN", "MYR", "NOK", "NZD", "PHP", "PKR", "PLN", "RUB", "SEK", "SGD", "THB", "TRY", "TWD", "ZAR"

```php
$coinmarketcap->getGlobalData(['convert' => 'EUR']);
```

result: 

```json
{
  "total_market_cap_usd": 498374989850,
  "total_24h_volume_usd": 20784204906,
  "bitcoin_percentage_of_market_cap": 33.49000000000000198951966012828052043914794921875,
  "active_currencies": 895,
  "active_assets": 580,
  "active_markets": 8419,
  "last_updated": 1517474662,
  "total_market_cap_eur": 401213795329,
  "total_24h_volume_eur": 16732199454
}
```