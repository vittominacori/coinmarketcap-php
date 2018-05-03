<?php

require __DIR__ . '/vendor/autoload.php';

use CoinMarketCap\Market;

$coinmarketcap = new Market();

echo json_encode($coinmarketcap->getTickerById(1, ['convert' => 'EUR']));