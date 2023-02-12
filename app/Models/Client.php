<?php

namespace App\Models;

use GuzzleHttp\Client;


class Client 
{


$client = new Client();

$response = $client->post($webhook_url, [
    'headers' => [
        'Content-Type' => 'application/json'
    ],
    'json' => [
        'text' => 'Hello, world!'
    ]
]);

}
