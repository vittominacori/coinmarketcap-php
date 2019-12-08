<?php

namespace CoinMarketCap\Features;

use CoinMarketCap\Utils\ApiRequest;

/**
 * Partners
 *
 * @link    https://github.com/vittominacori/coinmarketcap-php
 * @author  Vittorio Minacori (https://github.com/vittominacori)
 * @license https://github.com/vittominacori/coinmarketcap-php/blob/master/LICENSE (MIT License)
 */
class Partners extends ApiRequest
{
    /**
     * Partners constructor.
     * @param string $apiKey
     */
    public function __construct($apiKey)
    {
        parent::__construct($apiKey);
        self::$apiPath .= 'partners' . '/';
    }

    /**
     * @param array $params ["start", "limit", "aux" ]
     * @return mixed
     * @throws \Exception
     */
    public function flipsideFCASListingLatest($params = [])
    {
        return $this->get('flipside-crypto/fcas/listings/latest', $params);
    }

    /**
     * @param array $params ["id", "slug", "symbol", "aux" ]
     * @return mixed
     * @throws \Exception
     */
    public function flipsideFCASQuotesLatest($params = [])
    {
        return $this->get('flipside-crypto/fcas/quotes/latest', $params);
    }
}
