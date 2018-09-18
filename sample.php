<?php

require __DIR__ . '/vendor/autoload.php';

use CoinMarketCap\Market;

$coinmarketcap = new Market('yourApiKey');

try {
    echo json_encode($coinmarketcap->quotesLatest(['id' => 1, 'convert' => 'EUR']));
} catch (\Exception $e) {
    echo "Error {$e->getCode()}: {$e->getMessage()}";
}
