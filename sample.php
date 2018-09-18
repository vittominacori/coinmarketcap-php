<?php

require __DIR__ . '/vendor/autoload.php';

/** @var \CoinMarketCap\Api $cmc */
$cmc = new CoinMarketCap\Api('yourApiKey');

try {
    echo json_encode($cmc->cryptocurrency()->info(['id' => 1]));
} catch (\Exception $e) {
    echo "Error {$e->getCode()}: {$e->getMessage()}";
}
