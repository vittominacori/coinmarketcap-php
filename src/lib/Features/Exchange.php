<?php

namespace CoinMarketCap\Features;

use CoinMarketCap\Utils\ApiRequest;

/**
 * Fiat
 *
 * @link    https://github.com/vittominacori/coinmarketcap-php
 * @author  Shahrad Elahi (https://github.com/shahradelahi)
 * @license https://github.com/vittominacori/coinmarketcap-php/blob/master/LICENSE (MIT License)
 */
class Exchange extends ApiRequest
{
    /**
     * Cryptocurrency constructor.
     * @param string $apiKey
     */
    public function __construct($apiKey)
    {
        parent::__construct($apiKey);
        self::$apiPath .= 'exchange' . '/';
    }

    /**
     * @param array $params ["id", "slug", "aux"]
     * @return mixed
     * @throws \Exception
     */
    public function info($params = [])
    {
        return $this->get('info', $params);
    }

    /**
     * @param array $params ["listing_status", "slug", "start", "limit", "sort", "aux", "crypto_id"]
     * @return mixed
     * @throws \Exception
     */
    public function map($params = [])
    {
        return $this->get('map', $params);
    }

    /**
     * @param array $params ["start", "limit", "sort", "sort_dir", "market_type", "aux", "convert", "convert_id"]
     * @return mixed
     * @throws \Exception
     */
    public function listingsLatest($params)
    {
        return $this->get('listings/latest', $params);
    }

    /**
     * @param array $params ["id", "slug", "start", "limit", "aux", "matched_id", "matched_symbol", "category", "fee_type", "convert", "convert_id"]
     * @return mixed
     * @throws \Exception
     */
    public function marketPairsLatest($params)
    {
        return $this->get('market-pairs/latest', $params);
    }

}
