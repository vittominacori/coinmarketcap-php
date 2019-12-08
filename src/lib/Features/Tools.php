<?php

namespace CoinMarketCap\Features;

use CoinMarketCap\Utils\ApiRequest;

/**
 * Tools
 *
 * @link    https://github.com/vittominacori/coinmarketcap-php
 * @author  Vittorio Minacori (https://github.com/vittominacori)
 * @license https://github.com/vittominacori/coinmarketcap-php/blob/master/LICENSE (MIT License)
 */
class Tools extends ApiRequest
{
    /**
     * Tools constructor.
     * @param string $apiKey
     */
    public function __construct($apiKey)
    {
        parent::__construct($apiKey);
        self::$apiPath .= 'tools' . '/';
    }

    /**
     * @param array $params ["amount", "id", "symbol", "time", "convert", "convert_id" ]
     * @return mixed
     * @throws \Exception
     */
    public function priceConversion($params = [])
    {
        return $this->get('price-conversion', $params);
    }
}
