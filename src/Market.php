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
    private static $apiPath = "https://api.coinmarketcap.com/v2/";
    private static $headers = [
        'Accept' => 'application/json',
        'Content-Type' => 'application/json'
    ];

    public function __construct($apiPath = '', $headers = [])
    {
        if (!empty($apiPath)) {
            self::$apiPath = $apiPath;
        }
        if (!empty($headers)) {
            self::$headers = $headers;
        }
    }

    // public methods


    /**
     * @return mixed
     * @throws \Exception
     */
    public function getListings()
    {
        return $this->get('listings');
    }

    /**
     * @param array $params (Optional parameters "convert", "limit", "start")
     * @return mixed
     * @throws \Exception
     */
    public function getTicker($params = [])
    {
        return $this->get('ticker', $params);
    }

    /**
     * @param integer $id
     * @param array $params (Optional parameters "convert")
     * @return mixed
     * @throws \Exception
     */
    public function getTickerById($id, $params = [])
    {
        return $this->get('ticker/' . $id, $params);
    }

    /**
     * @param array $params (Optional parameters "convert")
     * @return mixed
     * @throws \Exception
     */
    public function getGlobalData($params = [])
    {
        return $this->get('global', $params);
    }

    // private methods

    private function get($endpoint, $parameters = [])
    {
        $apiCall = self::$apiPath . $endpoint;
        $response = Unirest\Request::get($apiCall, self::$headers, $parameters);

        if ($response->code == 200) {
            return $response->body;
        } else {
            throw new \Exception("Error: code {$response->code} during call to $endpoint with parameters " . json_encode($parameters));
        }
    }
}
