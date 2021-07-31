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
class Fiat extends ApiRequest
{
    /**
     * Cryptocurrency constructor.
     * @param string $apiKey
     */
    public function __construct($apiKey)
    {
        parent::__construct($apiKey);
        self::$apiPath .= 'fiat' . '/';
    }

    /**
     * @param array $params ["start", "limit", "sort", "include_metals"]
     * @return mixed
     * @throws \Exception
     */
    public function map($params = [])
    {
        return $this->get('map', $params);
    }

}
