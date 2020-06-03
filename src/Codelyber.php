<?php

declare(strict_types = 1);


require_once "../vendor/autoload.php";

use GuzzleHttp\Client;

$client = new Client([
    // Base URI is used with relative requests
    'base_uri' => 'https://api-ssl.bitly.com/',
]);

$response = $client->request('POST', 'v4/bitlinks', [
    'json' => [
        'long_url' => 'https://www.youtube.com/watch?v=sWoIUeZzCtM',
    ],
    'headers' => [
        'Authorization' => 'ca42b938cdf1eb06faafe7dc0222853d12a4456d'
    ],
    'verify' => false,
]);

if(in_array($response->getStatusCode(), [200, 201])) {
    $body = $response->getBody()->getContents();
    $arr_body = json_decode($body);
    echo $arr_body->link . "\n";
}



/*require_once '../vendor/autoload.php';

use GuzzleHttp\Client;

$client = new Client();

$long_url = 'https://www.youtube.com/watch?v=sWoIUeZzCtM';


$response = $client->post(
    'https://api-ssl.bitly.com/v4/shorten', [
        'headers' => [
            'Content-type' => 'application/json; charset=utf-8',
            'Authorization' => 'Bearer ' . 'ca42b938cdf1eb06faafe7dc0222853d12a4456d',
            'Accept'        => 'application/json'
        ],
        'json' => ['long_url' => $long_url]
    ]
);

if(in_array($response->getStatusCode(), [200, 201])) {
    $body = $response->getBody()->getContents();
    //var_dump($body);
     $arr_body = json_decode($body);
     echo $arr_body->link. "\n";
}
*/

/*
namespace CodelyTv\PhpBootstrap;

final class Codelyber
{

    private const GREETING = "CodelyTV";


    private $name;

    public function __construct(string $aName)
    {
        $this->name = $aName;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function greet(): string
    {
        return self::GREETING;
    }
}
*/
