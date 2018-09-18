<?php
/**
 * CoinMarketCap PHP
 *
 * @link      https://github.com/vittominacori/coinmarketcap-php
 * @author    Vittorio Minacori (https://github.com/vittominacori)
 * @license   https://github.com/vittominacori/coinmarketcap-php/blob/master/LICENSE (MIT License)
 */
namespace CoinMarketCap;

use Unirest;

/**
 * Class Market
 * @package CoinMarketCap
 */
class Market
{
    private static $apiPath = "https://pro-api.coinmarketcap.com/v1/cryptocurrency/";
    private static $headers = [
        'Accept' => 'application/json',
        'Content-Type' => 'application/json'
    ];

    public function __construct($apiKey = '')
    {
        self::$headers['X-CMC_PRO_API_KEY'] = $apiKey;
    }

    // public methods

    /**
     * @param array $params (Optional parameters "id", "symbol")
     * @return mixed
     * @throws \Exception
     */
    public function info($params = [])
    {
        return $this->get('info', $params);
    }

    /**
     * @param array $params (Optional parameters "listing_status", "limit", "start", "symbol")
     * @return mixed
     * @throws \Exception
     */
    public function map($params = [])
    {
        return $this->get('map', $params);
    }

    /**
     * @param array $params (Optional parameters "limit", "start", "convert", "sort", "sort_dir", "cryptocurrency_type")
     * @return mixed
     * @throws \Exception
     */
    public function listingsLatest($params)
    {
        return $this->get('listings/latest', $params);
    }

    /**
     * @param array $params (Optional parameters "id", "symbol", "convert")
     * @return mixed
     * @throws \Exception
     */
    public function quotesLatest($params = [])
    {
        return $this->get('quotes/latest', $params);
    }

    // private methods

    private function get($endpoint, $parameters = [])
    {
        $apiCall = self::$apiPath . $endpoint;
        $response = Unirest\Request::get($apiCall, self::$headers, $parameters);

        if ($response->code == 200) {
            return $response->body;
        } else {
            throw new \Exception($response->body->status->error_message, $response->body->status->error_code);
        }
    }
}
