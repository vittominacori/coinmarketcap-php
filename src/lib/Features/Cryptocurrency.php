<?php

namespace CoinMarketCap\Features;

use CoinMarketCap\Utils\ApiRequest;

/**
 * Cryptocurrency
 *
 * @link    https://github.com/vittominacori/coinmarketcap-php
 * @author  Vittorio Minacori (https://github.com/vittominacori)
 * @license https://github.com/vittominacori/coinmarketcap-php/blob/master/LICENSE (MIT License)
 */
class Cryptocurrency extends ApiRequest
{
    /**
     * Cryptocurrency constructor.
     * @param string $apiKey
     */
    public function __construct($apiKey)
    {
        parent::__construct($apiKey);
        self::$apiPath .= 'cryptocurrency' . '/';
    }

    /**
     * @param array $params ["listing_status", "start", "limit", "sort", "symbol", "aux"]
     * @return mixed
     * @throws \Exception
     */
    public function map($params = [])
    {
        return $this->get('map', $params);
    }

    /**
     * @param array $params ["id", "slug", "symbol", "aux"]
     * @return mixed
     * @throws \Exception
     */
    public function info($params = [])
    {
        return $this->get('info', $params);
    }

    /**
     * @param array $params ["start", "limit", "volume_24h_min", "convert", "convert_id", "sort", "sort_dir", "cryptocurrency_type", "aux"]
     * @return mixed
     * @throws \Exception
     */
    public function listingsLatest($params)
    {
        return $this->get('listings/latest', $params);
    }

    /**
     * @param array $params ["id", "slug", "symbol", "convert", "convert_id", "aux", "skip_invalid"]
     * @return mixed
     * @throws \Exception
     */
    public function quotesLatest($params = [])
    {
        return $this->get('quotes/latest', $params);
    }
}
