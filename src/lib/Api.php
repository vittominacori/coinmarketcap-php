<?php

namespace CoinMarketCap;

use CoinMarketCap\Features\Cryptocurrency;
use CoinMarketCap\Features\GlobalMetrics;

/**
 * Api
 *
 * @link    https://github.com/vittominacori/coinmarketcap-php
 * @author  Vittorio Minacori (https://github.com/vittominacori)
 * @license https://github.com/vittominacori/coinmarketcap-php/blob/master/LICENSE (MIT License)
 */
class Api
{
    private static $apiKey;
    private static $cryptocurrency = null;
    private static $globalMetrics = null;

    /**
     * Api constructor.
     * @param string $apiKey
     */
    public function __construct($apiKey)
    {
        self::$apiKey = $apiKey;
    }

    /**
     * @return Cryptocurrency
     */
    public static function cryptocurrency(): Cryptocurrency
    {
        self::$cryptocurrency = self::$cryptocurrency ?: new Cryptocurrency(self::$apiKey);
        return self::$cryptocurrency;
    }

    /**
     * @return GlobalMetrics
     */
    public static function globalMetrics(): GlobalMetrics
    {
        self::$globalMetrics = self::$globalMetrics ?: new GlobalMetrics(self::$apiKey);
        return self::$globalMetrics;
    }
}
