<?php

namespace CoinMarketCap\Features;

use CoinMarketCap\Utils\ApiRequest;

/**
 * GlobalMetrics
 *
 * @link    https://github.com/vittominacori/coinmarketcap-php
 * @author  Vittorio Minacori (https://github.com/vittominacori)
 * @license https://github.com/vittominacori/coinmarketcap-php/blob/master/LICENSE (MIT License)
 */
class GlobalMetrics extends ApiRequest
{
    /**
     * GlobalMetrics constructor.
     * @param string $apiKey
     */
    public function __construct($apiKey)
    {
        parent::__construct($apiKey);
        self::$apiPath .= 'global-metrics' . '/';
    }

    /**
     * @param array $params ["convert", "convert_id"]
     * @return mixed
     * @throws \Exception
     */
    public function quotesLatest($params = [])
    {
        return $this->get('quotes/latest', $params);
    }
}
