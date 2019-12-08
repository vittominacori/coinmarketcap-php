# CoinMarketCap for PHP

A PHP wrapper for [CoinMarketCap Professional API](https://pro.coinmarketcap.com/api/v1)

NOTES: only FREE APIs. Check features list [here](https://pro.coinmarketcap.com/features).

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

Returns a mapping of all cryptocurrencies to unique CoinMarketCap `id`s. Per our best practices we recommend utilizing CMC ID instead of cryptocurrency symbols to securely identify cryptocurrencies with our other endpoints and in your own application logic. Each cryptocurrency returned includes typical identifiers such as `name`, `symbol`, and `token_address` for flexible mapping to `id`.

By default this endpoint returns cryptocurrencies that have actively tracked markets on supported exchanges. You may receive a map of all inactive cryptocurrencies by passing `listing_status=inactive`. You may also receive a map of registered cryptocurrency projects that are listed but do not yet meet methodology requirements to have tracked markets via `listing_status=untracked`.

Cryptocurrencies returned include `first_historical_data` and `last_historical_data` timestamps to conveniently reference historical date ranges available to query with historical time-series data endpoints. You may also use the `aux` parameter to only include properties you require to slim down the payload if calling this endpoint frequently.

Params:
+ (string) `listing_status` - Default "active" - Only active cryptocurrencies are returned by default. Pass `inactive` to get a list of cryptocurrencies that are no longer active. Pass `untracked` to get a list of cryptocurrencies that are listed but do not yet meet methodology requirements to have tracked markets available. You may pass one or more comma-separated values.
+ (integer >= 1) `start` - Default 1 - Optionally offset the start (1-based index) of the paginated list of items to return.
+ (integer [1 .. 5000]) `limit` - Default 100 - Optionally specify the number of results to return. Use this parameter and the "start" parameter to determine your own pagination size.
+ (string) `sort` - Default "id" - Valid values: "cmc_rank", "id" - What field to sort the list of cryptocurrencies by.
+ (string) `symbol` - Optionally pass a comma-separated list of cryptocurrency symbols to return CoinMarketCap IDs for. If this option is passed, other options will be ignored.
+ (string) `aux` - Default "platform,first_historical_data,last_historical_data,is_active" - Optionally specify a comma-separated list of supplemental data fields to return. Pass `platform,first_historical_data,last_historical_data,is_active,status` to include all auxiliary fields.

```php
$response = $cmc->cryptocurrency()->map(['limit' => 3]);
```

```json
{
  "status": {
    "timestamp": "2019-12-08T16:29:05.373Z",
    "error_code": 0,
    "error_message": null,
    "elapsed": 11,
    "credit_count": 1,
    "notice": null
  },
  "data": [
    {
      "id": 1,
      "name": "Bitcoin",
      "symbol": "BTC",
      "slug": "bitcoin",
      "is_active": 1,
      "rank": 1,
      "first_historical_data": "2013-04-28T18:47:21.000Z",
      "last_historical_data": "2019-12-08T16:24:00.000Z",
      "platform": null
    },
    {
      "id": 2,
      "name": "Litecoin",
      "symbol": "LTC",
      "slug": "litecoin",
      "is_active": 1,
      "rank": 6,
      "first_historical_data": "2013-04-28T18:47:22.000Z",
      "last_historical_data": "2019-12-08T16:24:00.000Z",
      "platform": null
    },
    {
      "id": 3,
      "name": "Namecoin",
      "symbol": "NMC",
      "slug": "namecoin",
      "is_active": 1,
      "rank": 384,
      "first_historical_data": "2013-04-28T18:47:22.000Z",
      "last_historical_data": "2019-12-08T16:24:00.000Z",
      "platform": null
    }
  ]
}
```

### info

Returns all static metadata available for one or more cryptocurrencies. This information includes details like logo, description, official website URL, social links, and links to a cryptocurrency's technical documentation.

Params:
+ (string) `id` - One or more comma-separated CoinMarketCap cryptocurrency IDs.
+ (string) `slug` - Alternatively pass a comma-separated list of cryptocurrency slugs.
+ (string) `symbol` - Alternatively pass one or more comma-separated cryptocurrency symbols. At least one "id" or "slug" or "symbol" is required for this request.
+ (string) `aux` - Default "urls,logo,description,tags,platform,date_added,notice" - Optionally specify a comma-separated list of supplemental data fields to return. Pass `urls,logo,description,tags,platform,date_added,notice,status` to include all auxiliary fields.

```php
$response = $cmc->cryptocurrency()->info(['symbol' => 'BTC']);
```

```json
{
  "status": {
    "timestamp": "2019-12-08T16:32:46.310Z",
    "error_code": 0,
    "error_message": null,
    "elapsed": 8,
    "credit_count": 1,
    "notice": null
  },
  "data": {
    "BTC": {
      "urls": {
        "website": [
          "https://bitcoin.org/"
        ],
        "technical_doc": [
          "https://bitcoin.org/bitcoin.pdf"
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
          "https://blockchain.coinmarketcap.com/chain/bitcoin",
          "https://blockchain.info/",
          "https://live.blockcypher.com/btc/",
          "https://blockchair.com/bitcoin",
          "https://explorer.viabtc.com/btc"
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
      "description": "Bitcoin (BTC) is a consensus network that enables a new payment system and a completely digital currency. Powered by its users, it is a peer to peer payment network that requires no central authority to operate. On October 31st, 2008, an individual or group of individuals operating under the pseudonym \"Satoshi Nakamoto\" published the Bitcoin Whitepaper and described it as: \"a purely peer-to-peer version of electronic cash, which would allow online payments to be sent directly from one party to another without going through a financial institution.\"",
      "notice": null,
      "date_added": "2013-04-28T00:00:00.000Z",
      "tags": [
        "mineable"
      ],
      "platform": null,
      "category": "coin"
    }
  }
}
```

### listings/latest

Returns a paginated list of all active cryptocurrencies with latest market data. The default "market_cap" sort returns cryptocurrency in order of CoinMarketCap's market cap rank but you may configure this call to order by another market ranking field. Use the "convert" option to return market values in multiple fiat and cryptocurrency conversions in the same call.

Params: 
+ (integer >= 1) `start` - Default 1 - Optionally offset the start (1-based index) of the paginated list of items to return.
+ (integer [1 .. 5000]) `limit` - Default 100 - Optionally specify the number of results to return. Use this parameter and the "start" parameter to determine your own pagination size.
+ (integer [ 1 .. 100000000000 ]) `volume_24h_min` - Optionally specify a threshold of minimum 24 hour USD volume to filter results by.
+ (string) `convert` - Optionally calculate market quotes in up to 120 currencies at once by passing a comma-separated list of cryptocurrency or fiat currency symbols. Each additional convert option beyond the first requires an additional call credit. A list of supported fiat options can be found [here](https://pro.coinmarketcap.com/api/v1#section/Standards-and-Conventions). Each conversion is returned in its own "quote" object.
+ (string) `convert_id` - Optionally calculate market quotes by CoinMarketCap ID instead of symbol. This option is identical to `convert` outside of ID format. Ex: convert_id=1,2781 would replace convert=BTC,USD in your query. This parameter cannot be used when `convert` is used.
+ (string) `sort` - Default "market_cap" - Valid values: "name""symbol", "date_added", "market_cap", "market_cap_strict", "price", "circulating_supply", "total_supply", "max_supply", "num_market_pairs", "volume_24h", "percent_change_1h", "percent_change_24h", "percent_change_7d", "market_cap_by_total_supply_strict", "volume_7d""volume_30d" - What field to sort the list of cryptocurrencies by.
+ (string) `sort_dir` - Valid values: "asc", "desc" - The direction in which to order cryptocurrencies against the specified sort.
+ (string) `cryptocurrency_type` - Default "all" - Valid values: "all", "coins", "tokens" - The type of cryptocurrency to include.
+ (string) `aux` - Default "num_market_pairs,cmc_rank,date_added,tags,platform,max_supply,circulating_supply,total_supply" - Optionally specify a comma-separated list of supplemental data fields to return. Pass `num_market_pairs,cmc_rank,date_added,tags,platform,max_supply,circulating_supply,total_supply,market_cap_by_total_supply,volume_24h_reported,volume_7d,volume_7d_reported,volume_30d,volume_30d_reported` to include all auxiliary fields.

```php
$response = $cmc->cryptocurrency()->listingsLatest(['limit' => 3, 'convert' => 'EUR']);
```

```json
{
  "status": {
    "timestamp": "2019-12-08T16:45:07.024Z",
    "error_code": 0,
    "error_message": null,
    "elapsed": 13,
    "credit_count": 1,
    "notice": null
  },
  "data": [
    {
      "id": 1,
      "name": "Bitcoin",
      "symbol": "BTC",
      "slug": "bitcoin",
      "num_market_pairs": 7761,
      "date_added": "2013-04-28T00:00:00.000Z",
      "tags": [
        "mineable"
      ],
      "max_supply": 21000000,
      "circulating_supply": 18090537,
      "total_supply": 18090537,
      "platform": null,
      "cmc_rank": 1,
      "last_updated": "2019-12-08T16:44:34.000Z",
      "quote": {
        "EUR": {
          "price": 6847.517756176467,
          "volume_24h": 13737233429.06731,
          "percent_change_1h": -0.581249,
          "percent_change_24h": 0.0896832,
          "percent_change_7d": 2.3688917,
          "market_cap": 123875273326.26735,
          "last_updated": "2019-12-08T16:44:01.000Z"
        }
      }
    },
    {
      "id": 1027,
      "name": "Ethereum",
      "symbol": "ETH",
      "slug": "ethereum",
      "num_market_pairs": 5360,
      "date_added": "2015-08-07T00:00:00.000Z",
      "tags": [
        "mineable"
      ],
      "max_supply": null,
      "circulating_supply": 108843495.0615,
      "total_supply": 108843495.0615,
      "platform": null,
      "cmc_rank": 2,
      "last_updated": "2019-12-08T16:44:24.000Z",
      "quote": {
        "EUR": {
          "price": 136.75609521817026,
          "volume_24h": 5620634248.804599,
          "percent_change_1h": -0.336326,
          "percent_change_24h": 1.29639,
          "percent_change_7d": 0.4907828,
          "market_cap": 14885011374.50894,
          "last_updated": "2019-12-08T16:44:01.000Z"
        }
      }
    },
    {
      "id": 52,
      "name": "XRP",
      "symbol": "XRP",
      "slug": "xrp",
      "num_market_pairs": 513,
      "date_added": "2013-08-04T00:00:00.000Z",
      "tags": [
        
      ],
      "max_supply": 100000000000,
      "circulating_supply": 43285660917,
      "total_supply": 99991237614,
      "platform": null,
      "cmc_rank": 3,
      "last_updated": "2019-12-08T16:44:05.000Z",
      "quote": {
        "EUR": {
          "price": 0.20916204859139653,
          "volume_24h": 969887537.110283,
          "percent_change_1h": -0.804959,
          "percent_change_24h": 1.95611,
          "percent_change_7d": 3.58259604,
          "market_cap": 9053717512.032267,
          "last_updated": "2019-12-08T16:44:01.000Z"
        }
      }
    }
  ]
}
```

### quotes/latest

Returns the latest market quote for 1 or more cryptocurrencies. Use the "convert" option to return market values in multiple fiat and cryptocurrency conversions in the same call.

Params:
+ (string) `id` - One or more comma-separated CoinMarketCap cryptocurrency IDs.
+ (string) `slug` - Alternatively pass a comma-separated list of cryptocurrency slugs.
+ (string) `symbol` - Alternatively pass one or more comma-separated cryptocurrency symbols. At least one "id" or "slug" or "symbol" is required for this request.
+ (string) `convert` - Optionally calculate market quotes in up to 120 currencies at once by passing a comma-separated list of cryptocurrency or fiat currency symbols. Each additional convert option beyond the first requires an additional call credit. A list of supported fiat options can be found [here](https://pro.coinmarketcap.com/api/v1#section/Standards-and-Conventions). Each conversion is returned in its own "quote" object.
+ (string) `convert_id` - Optionally calculate market quotes by CoinMarketCap ID instead of symbol. This option is identical to `convert` outside of ID format. Ex: convert_id=1,2781 would replace convert=BTC,USD in your query. This parameter cannot be used when `convert` is used.
+ (string) `aux` - Default "num_market_pairs,cmc_rank,date_added,tags,platform,max_supply,circulating_supply,total_supply" - Optionally specify a comma-separated list of supplemental data fields to return. Pass `num_market_pairs,cmc_rank,date_added,tags,platform,max_supply,circulating_supply,total_supply,market_cap_by_total_supply,volume_24h_reported,volume_7d,volume_7d_reported,volume_30d,volume_30d_reported` to include all auxiliary fields.
+ (boolean) `skip_invalid` - Default false - Pass `true` to relax request validation rules. When requesting records on multiple cryptocurrencies an error is returned if no match is found for 1 or more requested cryptocurrencies. If set to true, invalid lookups will be skipped allowing valid cryptocurrencies to still be returned.

```php
$response = $cmc->cryptocurrency()->quotesLatest(['id' => 1, 'convert' => 'EUR']);
```

```json
{
  "status": {
    "timestamp": "2019-12-08T16:50:02.600Z",
    "error_code": 0,
    "error_message": null,
    "elapsed": 17,
    "credit_count": 1,
    "notice": null
  },
  "data": {
    "1": {
      "id": 1,
      "name": "Bitcoin",
      "symbol": "BTC",
      "slug": "bitcoin",
      "num_market_pairs": 7761,
      "date_added": "2013-04-28T00:00:00.000Z",
      "tags": [
        "mineable"
      ],
      "max_supply": 21000000,
      "circulating_supply": 18090537,
      "total_supply": 18090537,
      "platform": null,
      "cmc_rank": 1,
      "last_updated": "2019-12-08T16:49:31.000Z",
      "quote": {
        "EUR": {
          "price": 6846.048756240301,
          "volume_24h": 13780116049.701561,
          "percent_change_1h": -0.573398,
          "percent_change_24h": 0.0698591,
          "percent_change_7d": 2.34665175,
          "market_cap": 123848698328.56917,
          "last_updated": "2019-12-08T16:49:01.000Z"
        }
      }
    }
  }
}
```

## Call GlobalMetrics APIs

### quotes/latest

Returns the latest global cryptocurrency market metrics. Use the "convert" option to return market values in multiple fiat and cryptocurrency conversions in the same call.

Params:
+ (string) `convert` - Optionally calculate market quotes in up to 120 currencies at once by passing a comma-separated list of cryptocurrency or fiat currency symbols. Each additional convert option beyond the first requires an additional call credit. A list of supported fiat options can be found [here](https://pro.coinmarketcap.com/api/v1#section/Standards-and-Conventions). Each conversion is returned in its own "quote" object.
+ (string) `convert_id` - Optionally calculate market quotes by CoinMarketCap ID instead of symbol. This option is identical to `convert` outside of ID format. Ex: convert_id=1,2781 would replace convert=BTC,USD in your query. This parameter cannot be used when `convert` is used.

```php
$response = $cmc->globalMetrics()->quotesLatest(['convert' => 'EUR']);
```

```json
{
  "status": {
    "timestamp": "2019-12-08T16:52:15.834Z",
    "error_code": 0,
    "error_message": null,
    "elapsed": 14,
    "credit_count": 1,
    "notice": null
  },
  "data": {
    "active_cryptocurrencies": 3202,
    "total_cryptocurrencies": 4904,
    "active_market_pairs": 20818,
    "active_exchanges": 614,
    "total_exchanges": 844,
    "eth_dominance": 8.01647,
    "btc_dominance": 66.7296,
    "quote": {
      "EUR": {
        "total_market_cap": 185597924909.75104,
        "total_volume_24h": 45763346301.02166,
        "total_volume_24h_reported": 50288735661.71643,
        "altcoin_volume_24h": 31983230251.320095,
        "altcoin_volume_24h_reported": 35040992890.64553,
        "altcoin_market_cap": 61749226581.18235,
        "last_updated": "2019-12-08T16:51:01.000Z"
      }
    },
    "last_updated": "2019-12-08T16:50:00.000Z"
  }
}
```

## Call Tools APIs

### price-conversion

Convert an amount of one cryptocurrency or fiat currency into one or more different currencies utilizing the latest market rate for each currency. You may optionally pass a historical timestamp as time to convert values based on historical rates (as your API plan supports).

Params:
+ (number [ 1e-8 .. 1000000000 ] ) `amount` - An amount of currency to convert.
+ (string) `id` - The CoinMarketCap currency ID of the base cryptocurrency or fiat to convert from.
+ (string) `symbol` - Alternatively the currency symbol of the base cryptocurrency or fiat to convert from.
+ (string) `time` - Optional timestamp (Unix or ISO 8601) to reference historical pricing during conversion. If not passed, the current time will be used. If passed, we'll reference the closest historic values available for this conversion.
+ (string) `convert` - Pass up to 120 comma-separated fiat or cryptocurrency symbols to convert the source amount to.

```php
$response = $cmc->tools()->priceConversion(['amount' => 1, 'symbol' => 'BTC']);
```

```json
{
  "status": {
    "timestamp": "2019-12-08T15:41:33.518Z",
    "error_code": 0,
    "error_message": null,
    "elapsed": 8,
    "credit_count": 1,
    "notice": null
  },
  "data": {
    "id": 1,
    "symbol": "BTC",
    "name": "Bitcoin",
    "amount": 1,
    "last_updated": "2019-12-08T15:40:32.000Z",
    "quote": {
      "USD": {
        "price": 7616.58696412,
        "last_updated": "2019-12-08T15:40:32.000Z"
      }
    }
  }
}
```

## Call Partners APIs

### flipside-crypto/fcas/listings/latest

Returns a paginated list of FCAS scores for all cryptocurrencies currently supported by FCAS. FCAS ratings are on a 0-1000 point scale with a corresponding letter grade and is updated once a day at UTC midnight.

Params:
+ (integer >= 1) `start` - Default 1 - Optionally offset the start (1-based index) of the paginated list of items to return.
+ (integer [ 1 .. 5000 ]) `limit` - Default 100 - Optionally specify the number of results to return. Use this parameter and the "start" parameter to determine your own pagination size.
+ (string) `aux` - Default "point_change_24h,percent_change_24h" - Optionally specify a comma-separated list of supplemental data fields to return. Pass `point_change_24h,percent_change_24h` to include all auxiliary fields.

```php
$response = $cmc->partners()->flipsideFCASListingLatest(['limit' => 3]);
```

```json
{
  "status": {
    "timestamp": "2019-12-08T16:04:04.084Z",
    "error_code": 0,
    "error_message": null,
    "elapsed": 5,
    "credit_count": 1,
    "notice": null
  },
  "data": [
    {
      "id": 1027,
      "name": "Ethereum",
      "symbol": "ETH",
      "slug": "ethereum",
      "score": 936,
      "grade": "S",
      "last_updated": "2019-12-08T00:00:00Z"
    },
    {
      "id": 1765,
      "name": "EOS",
      "symbol": "EOS",
      "slug": "eos",
      "score": 929,
      "grade": "S",
      "last_updated": "2019-12-08T00:00:00Z"
    },
    {
      "id": 1,
      "name": "Bitcoin",
      "symbol": "BTC",
      "slug": "bitcoin",
      "score": 907,
      "grade": "S",
      "last_updated": "2019-12-08T00:00:00Z"
    }
  ]
}
```

### flipside-crypto/fcas/quotes/latest

Returns the latest FCAS score for 1 or more cryptocurrencies. FCAS ratings are on a 0-1000 point scale with a corresponding letter grade and is updated once a day at UTC midnight.

Params:
+ (string) `id` - One or more comma-separated cryptocurrency CoinMarketCap IDs.
+ (string) `slug` - Alternatively pass a comma-separated list of cryptocurrency slugs.
+ (string) `symbol` - Alternatively pass one or more comma-separated cryptocurrency symbols. Example: "BTC,ETH". At least one "id" or "slug" or "symbol" is required for this request.
+ (string) `aux` - Default "point_change_24h,percent_change_24h" - Optionally specify a comma-separated list of supplemental data fields to return. Pass `point_change_24h,percent_change_24h` to include all auxiliary fields.

```php
$response = $cmc->partners()->flipsideFCASQuotesLatest(['symbol' => 'BTC']);
```

```json
{
  "status": {
    "timestamp": "2019-12-08T16:16:15.082Z",
    "error_code": 0,
    "error_message": null,
    "elapsed": 6,
    "credit_count": 1,
    "notice": null
  },
  "data": {
    "BTC": {
      "id": 1,
      "name": "Bitcoin",
      "symbol": "BTC",
      "slug": "bitcoin",
      "score": 907,
      "grade": "S",
      "last_updated": "2019-12-08T00:00:00Z",
      "percent_change_24h": 0.11,
      "point_change_24h": 1
    }
  }
}
```

## License

Code released under the [MIT License](https://github.com/vittominacori/coinmarketcap-php/blob/master/LICENSE).
