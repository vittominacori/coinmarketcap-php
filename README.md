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


#### Listings

Description:
+ This method displays all active cryptocurrency listings in one call. Use the "id" field on the Ticker endpoint to query more information on a specific cryptocurrency.

```php
$coinmarketcap->getListings();
```

result: 

```json
{
  "data": [
    {
      "id": 1,
      "name": "Bitcoin",
      "symbol": "BTC",
      "website_slug": "bitcoin"
    },
    {
      "id": 2,
      "name": "Litecoin",
      "symbol": "LTC",
      "website_slug": "litecoin"
    },
    {
      "id": 3,
      "name": "Namecoin",
      "symbol": "NMC",
      "website_slug": "namecoin"
    },
    {
      "id": 4,
      "name": "Terracoin",
      "symbol": "TRC",
      "website_slug": "terracoin"
    },
    (...)
  ],
  "metadata": {
    "timestamp": 1525352247,
    "num_cryptocurrencies": 1604,
    "error": null
  }
}
```


#### Ticker

Description:
+ This method displays cryptocurrency ticker data in order of rank. The maximum number of results per call is 100. Pagination is possible by using the start and limit parameters.

Optional parameters:
+ (int) start - return results from rank [start] and above (default is 1)
+ (int) limit - return a maximum of [limit] results (default is 100; max is 100)
+ (string) convert - return pricing info in terms of another currency. Valid fiat currency values are: "AUD", "BRL", "CAD", "CHF", "CLP", "CNY", "CZK", "DKK", "EUR", "GBP", "HKD", "HUF", "IDR", "ILS", "INR", "JPY", "KRW", "MXN", "MYR", "NOK", "NZD", "PHP", "PKR", "PLN", "RUB", "SEK", "SGD", "THB", "TRY", "TWD", "ZAR". Valid cryptocurrency values are: "BTC", "ETH" "XRP", "LTC", and "BCH"

```php
$coinmarketcap->getTicker(['convert' => 'EUR', 'start' => 10, 'limit' => 10]);
```

result: 

```json
{
  "data": {
    "131": {
      "id": 131,
      "name": "Dash",
      "symbol": "DASH",
      "website_slug": "dash",
      "rank": 13,
      "circulating_supply": 8044183.0,
      "total_supply": 8044183.0,
      "max_supply": 18900000.0,
      "quotes": {
        "USD": {
          "price": 487.954,
          "volume_24h": 109381000.0,
          "market_cap": 3925191193.0,
          "percent_change_1h": 1.17,
          "percent_change_24h": 3.58,
          "percent_change_7d": 3.28
        },
        "EUR": {
          "price": 407.240552952,
          "volume_24h": 91288070.028,
          "market_cap": 3275917468.0,
          "percent_change_1h": 1.17,
          "percent_change_24h": 3.58,
          "percent_change_7d": 3.28
        }
      },
      "last_updated": 1525351442
    },
    "328": {
      "id": 328,
      "name": "Monero",
      "symbol": "XMR",
      "website_slug": "monero",
      "rank": 12,
      "circulating_supply": 15993246.0,
      "total_supply": 15993246.0,
      "max_supply": null,
      "quotes": {
        "USD": {
          "price": 246.453,
          "volume_24h": 83299300.0,
          "market_cap": 3941583393.0,
          "percent_change_1h": 1.23,
          "percent_change_24h": 1.17,
          "percent_change_7d": -5.47
        },
        "EUR": {
          "price": 205.686716364,
          "volume_24h": 69520596.1884,
          "market_cap": 3289598201.0,
          "percent_change_1h": 1.23,
          "percent_change_24h": 1.17,
          "percent_change_7d": -5.47
        }
      },
      "last_updated": 1525351452
    },
    (...)
    "1958": {
      "id": 1958,
      "name": "TRON",
      "symbol": "TRX",
      "website_slug": "tron",
      "rank": 10,
      "circulating_supply": 65748111645.0,
      "total_supply": 100000000000.0,
      "max_supply": null,
      "quotes": {
        "USD": {
          "price": 0.0879502,
          "volume_24h": 614788000.0,
          "market_cap": 5782559569.0,
          "percent_change_1h": 0.69,
          "percent_change_24h": -3.11,
          "percent_change_7d": 26.69
        },
        "EUR": {
          "price": 0.0734021815,
          "volume_24h": 513094687.344,
          "market_cap": 4826054825.0,
          "percent_change_1h": 0.69,
          "percent_change_24h": -3.11,
          "percent_change_7d": 26.69
        }
      },
      "last_updated": 1525351455
    }
  },
  "metadata": {
    "timestamp": 1525351470,
    "num_cryptocurrencies": 1604,
    "error": null
  }
}
```


#### Ticker (Specific Currency)

Description:
+ This method displays ticker data for a specific cryptocurrency. Use the "id" field from the getListings method as param.

Optional parameters:
+ (string) convert - return pricing info in terms of another currency. Valid fiat currency values are: "AUD", "BRL", "CAD", "CHF", "CLP", "CNY", "CZK", "DKK", "EUR", "GBP", "HKD", "HUF", "IDR", "ILS", "INR", "JPY", "KRW", "MXN", "MYR", "NOK", "NZD", "PHP", "PKR", "PLN", "RUB", "SEK", "SGD", "THB", "TRY", "TWD", "ZAR". Valid cryptocurrency values are: "BTC", "ETH" "XRP", "LTC", and "BCH"

```php
$coinmarketcap->getTickerById(1, ['convert' => 'EUR']);
```

result: 

```json
{
  "data": {
    "id": 1,
    "name": "Bitcoin",
    "symbol": "BTC",
    "website_slug": "bitcoin",
    "rank": 1,
    "circulating_supply": 17012850.0,
    "total_supply": 17012850.0,
    "max_supply": 21000000.0,
    "quotes": {
      "USD": {
        "price": 9265.88,
        "volume_24h": 8084730000.0,
        "market_cap": 157639026558.0,
        "percent_change_1h": 0.67,
        "percent_change_24h": 1.33,
        "percent_change_7d": 4.7
      },
      "EUR": {
        "price": 7733.19225744,
        "volume_24h": 6747418641.24,
        "market_cap": 131563639897.0,
        "percent_change_1h": 0.67,
        "percent_change_24h": 1.33,
        "percent_change_7d": 4.7
      }
    },
    "last_updated": 1525351771
  },
  "metadata": {
    "timestamp": 1525351800,
    "error": null
  }
}
```

sample error response:

```json
{
    "data": null, 
    "metadata": {
        "timestamp": 1525137187, 
        "error": "id not found"
    }
}
```


#### Global Data

Description: 
+ This methid displays the global data found at the top of coinmarketcap.com.

Optional parameters:
+ (string) convert - return pricing info in terms of another currency. Valid fiat currency values are: "AUD", "BRL", "CAD", "CHF", "CLP", "CNY", "CZK", "DKK", "EUR", "GBP", "HKD", "HUF", "IDR", "ILS", "INR", "JPY", "KRW", "MXN", "MYR", "NOK", "NZD", "PHP", "PKR", "PLN", "RUB", "SEK", "SGD", "THB", "TRY", "TWD", "ZAR". Valid cryptocurrency values are: "BTC", "ETH" "XRP", "LTC", and "BCH"

```php
$coinmarketcap->getGlobalData(['convert' => 'EUR']);
```

result: 

```json
{
  "data": {
    "active_cryptocurrencies": 1604,
    "active_markets": 10627,
    "bitcoin_percentage_of_market_cap": 35.68,
    "quotes": {
      "USD": {
        "total_market_cap": 442240921543.0,
        "total_volume_24h": 26428639806.0
      },
      "EUR": {
        "total_market_cap": 369088966229.0,
        "total_volume_24h": 22057025638.0
      }
    },
    "last_updated": 1525352071
  },
  "metadata": {
    "timestamp": 1525352031,
    "error": null
  }
}
```