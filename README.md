# CoinMarketCap for PHP

A PHP wrapper for [CoinMarketCap Professional API](https://pro.coinmarketcap.com/api/v1)

NOTES: only FREE apis. Check features list [here](https://pro.coinmarketcap.com/features).

## Install

```
composer require vittominacori/coinmarketcap-php
```

## Usage

### Create client

```php
$cmc = new CoinMarketCap\Api('yourApiClient');
```

## Call Cryptocurrency APIs

### map

Returns a paginated list of all cryptocurrencies by CoinMarketCap ID. We recommend using this convenience endpoint to lookup and utilize our unique cryptocurrency id across all endpoints as typical identifiers like ticker symbols can match multiple cryptocurrencies and change over time. As a convenience you may pass a comma-separated list of cryptocurrency symbols as symbol to filter this list to only those you require.

Params:
+ (string) listing_status - Default "active" - Only active coins are returned by default. Pass 'inactive' to get a list of coins that are no longer active. - Valid values: "active" "inactive".
+ (integer >= 1) start - Default 1 - Optionally offset the start (1-based index) of the paginated list of items to return.
+ (integer [1 .. 5000]) limit - Default 100 - Optionally specify the number of results to return. Use this parameter and the "start" parameter to determine your own pagination size.
+ (string) symbol - Optionally pass a comma-separated list of cryptocurrency symbols to return CoinMarketCap IDs for. If this option is passed, other options will be ignored.

```php
$response = $cmc->cryptocurrency()->map(['limit' => 3]);
```

```json
{
  "status": {
    "timestamp": "2018-09-18T14:28:34.173Z",
    "error_code": 0,
    "error_message": null,
    "elapsed": 7,
    "credit_count": 1
  },
  "data": [
    {
      "id": 1,
      "name": "Bitcoin",
      "symbol": "BTC",
      "slug": "bitcoin",
      "is_active": 1,
      "first_historical_data": "2013-04-28T18:47:21.000Z",
      "last_historical_data": "2018-09-18T14:24:00.000Z"
    },
    {
      "id": 2,
      "name": "Litecoin",
      "symbol": "LTC",
      "slug": "litecoin",
      "is_active": 1,
      "first_historical_data": "2013-04-28T18:47:22.000Z",
      "last_historical_data": "2018-09-18T14:24:00.000Z"
    },
    {
      "id": 3,
      "name": "Namecoin",
      "symbol": "NMC",
      "slug": "namecoin",
      "is_active": 1,
      "first_historical_data": "2013-04-28T18:47:22.000Z",
      "last_historical_data": "2018-09-18T14:24:00.000Z"
    }
  ]
}
```

### info

Returns all static metadata for one or more cryptocurrencies including name, symbol, logo, and its various registered URLs.

Params:
+ (string) id - One or more comma-separated cryptocurrency CoinMarketCap IDs. Example: 1,2.
+ (string) symbol - Alternatively pass one or more comma-separated cryptocurrency symbols. Example: "BTC,ETH". At least one "id" or "symbol" is required.

```php
$response = $cmc->cryptocurrency()->info(['id' => 1]);
```

```json
{
  "status": {
    "timestamp": "2018-09-18T14:23:35.891Z",
    "error_code": 0,
    "error_message": null,
    "elapsed": 8,
    "credit_count": 1
  },
  "data": {
    "1": {
      "urls": {
        "website": [
          "https://bitcoin.org/"
        ],
        "twitter": [
          
        ],
        "reddit": [
          "https://reddit.com/r/bitcoin"
        ],
        "message_board": [
          "https://bitcointalk.org"
        ],
        "announcement": [
          
        ],
        "chat": [
          
        ],
        "explorer": [
          "https://blockchain.info/",
          "https://live.blockcypher.com/btc/",
          "https://blockchair.com/bitcoin/blocks"
        ],
        "source_code": [
          "https://github.com/bitcoin/"
        ]
      },
      "logo": "https://s2.coinmarketcap.com/static/img/coins/64x64/1.png",
      "id": 1,
      "name": "Bitcoin",
      "symbol": "BTC",
      "slug": "bitcoin",
      "date_added": "2013-04-28T00:00:00.000Z",
      "tags": [
        "mineable"
      ],
      "category": "coin"
    }
  }
}
```

### listings/latest

Get a paginated list of all cryptocurrencies with latest market data. You can configure this call to sort by market cap or another market ranking field. Use the "convert" option to return market values in multiple fiat and cryptocurrency conversions in the same call.

Params: 
+ (integer >= 1) start - Default 1 - Optionally offset the start (1-based index) of the paginated list of items to return.
+ (integer [1 .. 5000]) limit - Default 100 - Optionally specify the number of results to return. Use this parameter and the "start" parameter to determine your own pagination size.
+ (string) convert - Default "USD" - Optionally calculate market quotes in up to 32 currencies at once by passing a comma-separated list of cryptocurrency or fiat currency symbols. Each additional convert option beyond the first requires an additional call credit. A list of supported fiat options can be found [here](https://pro.coinmarketcap.com/api/v1#section/Standards-and-Conventions). Each conversion is returned in its own "quote" object.
+ (string) sort - Default "market_cap" - What field to sort the list of cryptocurrencies by. - Valid values: "name" "symbol" "date_added" "market_cap" "price" "circulating_supply" "total_supply" "max_supply" "num_market_pairs" "volume_24h" "percent_change_1h" "percent_change_24h" "percent_change_7d".
+ (string) sort_dir - The direction in which to order cryptocurrencies against the specified sort. - Valid values: "asc" "desc".
+ (string) cryptocurrency_type - Default "all" - The type of cryptocurrency to include. - Valid values: "all" "coins" "tokens".

```php
$response = $cmc->cryptocurrency()->listingsLatest(['limit' => 3, 'convert' => 'EUR']);
```

```json
{
  "status": {
    "timestamp": "2018-09-18T14:19:30.058Z",
    "error_code": 0,
    "error_message": null,
    "elapsed": 5,
    "credit_count": 1
  },
  "data": [
    {
      "id": 1,
      "name": "Bitcoin",
      "symbol": "BTC",
      "slug": "bitcoin",
      "circulating_supply": 17274437,
      "total_supply": 17274437,
      "max_supply": 21000000,
      "date_added": "2013-04-28T00:00:00.000Z",
      "num_market_pairs": 6196,
      "cmc_rank": 1,
      "last_updated": "2018-09-18T14:18:20.000Z",
      "quote": {
        "EUR": {
          "price": 5453.483411,
          "volume_24h": 3620113441.55994701385498046875,
          "percent_change_1h": 0.23269,
          "percent_change_24h": -0.4964,
          "percent_change_7d": 1.0169,
          "market_cap": 94205855621.49392,
          "last_updated": "2018-09-18T14:15:00.000Z"
        }
      }
    },
    {
      "id": 1027,
      "name": "Ethereum",
      "symbol": "ETH",
      "slug": "ethereum",
      "circulating_supply": 102035628.8739,
      "total_supply": 102035628.8739,
      "max_supply": null,
      "date_added": "2015-08-07T00:00:00.000Z",
      "num_market_pairs": 4306,
      "cmc_rank": 2,
      "last_updated": "2018-09-18T14:18:33.000Z",
      "quote": {
        "EUR": {
          "price": 180.34037,
          "volume_24h": 1875203831.40084,
          "percent_change_1h": 0.20369,
          "percent_change_24h": -2.0057,
          "percent_change_7d": 10.34469,
          "market_cap": 18401143121.22748,
          "last_updated": "2018-09-18T14:15:00.000Z"
        }
      }
    },
    {
      "id": 52,
      "name": "XRP",
      "symbol": "XRP",
      "slug": "ripple",
      "circulating_supply": 39809069106,
      "total_supply": 99991841593,
      "max_supply": 100000000000,
      "date_added": "2013-08-04T00:00:00.000Z",
      "num_market_pairs": 205,
      "cmc_rank": 3,
      "last_updated": "2018-09-18T14:19:09.000Z",
      "quote": {
        "EUR": {
          "price": 0.27389,
          "volume_24h": 395866029.038812,
          "percent_change_1h": 4.00389,
          "percent_change_24h": 13.3679,
          "percent_change_7d": 18.0235,
          "market_cap": 10903443380.678461,
          "last_updated": "2018-09-18T14:15:00.000Z"
        }
      }
    }
  ]
}
```

### quotes/latest

Get the latest market quote for 1 or more cryptocurrencies. Use the "convert" option to return market values in multiple fiat and cryptocurrency conversions in the same call.

Params:
+ (string) id - One or more comma-separated cryptocurrency CoinMarketCap IDs. Example: 1,2.
+ (string) symbol - Alternatively pass one or more comma-separated cryptocurrency symbols. Example: "BTC,ETH". At least one "id" or "symbol" is required.
+ (string) convert - Default "USD" - Optionally calculate market quotes in up to 32 currencies at once by passing a comma-separated list of cryptocurrency or fiat currency symbols. Each additional convert option beyond the first requires an additional call credit. A list of supported fiat options can be found [here](https://pro.coinmarketcap.com/api/v1#section/Standards-and-Conventions). Each conversion is returned in its own "quote" object.

```php
$response = $cmc->cryptocurrency()->quotesLatest(['id' => 1, 'convert' => 'EUR']);
```

```json
{
  "status": {
    "timestamp": "2018-09-18T14:08:03.988Z",
    "error_code": 0,
    "error_message": null,
    "elapsed": 5,
    "credit_count": 1
  },
  "data": {
    "1": {
      "id": 1,
      "name": "Bitcoin",
      "symbol": "BTC",
      "slug": "bitcoin",
      "circulating_supply": 17274400,
      "total_supply": 17274400,
      "max_supply": 21000000,
      "date_added": "2013-04-28T00:00:00.000Z",
      "num_market_pairs": 6196,
      "cmc_rank": 1,
      "last_updated": "2018-09-18T14:06:25.000Z",
      "quote": {
        "EUR": {
          "price": 5445.68744,
          "volume_24h": 3655275984.03052,
          "percent_change_1h": 0.3710,
          "percent_change_24h": -0.6898,
          "percent_change_7d": 0.9559,
          "market_cap": 94070983274.072128,
          "last_updated": "2018-09-18T14:05:00.000Z"
        }
      }
    }
  }
}
```

## Call GlobalMetrics APIs

### quotes/latest

Get the latest quote of aggregate market metrics. Use the "convert" option to return market values in multiple fiat and cryptocurrency conversions in the same call.

Params:
+ (string) convert - OPTIONAL - default "USD" - Optionally calculate market quotes in up to 32 currencies at once by passing a comma-separated list of cryptocurrency or fiat currency symbols. Each additional convert option beyond the first requires an additional call credit. A list of supported fiat options can be found [here](https://pro.coinmarketcap.com/api/v1#section/Standards-and-Conventions). Each conversion is returned in its own "quote" object.

```php
$response = $cmc->globalMetrics()->quotesLatest(['convert' => 'EUR']);
```

```json
{
  "status": {
    "timestamp": "2018-09-18T14:02:00.100Z",
    "error_code": 0,
    "error_message": null,
    "elapsed": 4,
    "credit_count": 1
  },
  "data": {
    "active_cryptocurrencies": 1969,
    "active_market_pairs": 14052,
    "active_exchanges": 219,
    "eth_dominance": 10.7,
    "btc_dominance": 55.3,
    "quote": {
      "EUR": {
        "total_market_cap": 169987221659,
        "total_volume_24h": 11805377386,
        "last_updated": "2018-09-18T14:00:00.000Z"
      }
    },
    "last_updated": "2018-09-18T13:52:00.000Z"
  }
}
```

## License

Code released under the [MIT License](https://github.com/vittominacori/coinmarketcap-php/blob/master/LICENSE).
