<?php

require __DIR__ . '/vendor/autoload.php';

use CoinMarketCap\Market;

$coinmarketcap = new Market();

$result = $coinmarketcap->getListings();

echo json_encode($result);