<?php

require '../vendor/autoload.php';

$client = new GuzzleHttp\Client();
$res = $client->request('GET', 'http://localhost:8000/api/cards');
echo $res->getStatusCode();
echo "\n\n";
echo $res->getHeaderLine('content-type');
echo "\n\n";
echo $res->getBody();

echo "\n\n";
