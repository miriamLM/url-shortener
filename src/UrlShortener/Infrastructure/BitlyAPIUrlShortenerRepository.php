<?php

declare(strict_types=1);

namespace LaSalle\UrlShortener\MiriamLopez\UrlShortener\Infrastructure;

use GuzzleHttp\Exception\ClientException;
use LaSalle\UrlShortener\MiriamLopez\UrlShortener\Domain\Exceptions\UrlNotFound;
use LaSalle\UrlShortener\MiriamLopez\UrlShortener\Domain\UrlName;
use LaSalle\UrlShortener\MiriamLopez\UrlShortener\Domain\UrlShortenerRepository;
use GuzzleHttp\Client;
use LaSalle\UrlShortener\MiriamLopez\UrlShortener\Infrastructure\Exceptions\BitlyAPIUnavailable;

final class BitlyAPIUrlShortenerRepository implements UrlShortenerRepository
{

    public function urlShorten(UrlName $url): string
    {
        $client = new Client(
            [
                'base_uri' => 'https://api-ssl.bitly.com/',
            ]
        );

        try {
            $response = $client->request(
                'POST',
                'v4/bitlinks',
                [
                    'json' => [
                        'long_url' => $url->value(),
                    ],
                    'headers' => [
                        'Authorization' => 'ca42b938cdf1eb06faafe7dc0222853d12a4456d'
                    ],
                    'verify' => false,
                ]
            );
        } catch (ClientException $exception) {
            throw new UrlNotFound();
        }

        $statusResponse = $response->getStatusCode();
        $bodyResponse = $response->getBody()->getContents();

        if (404 == $statusResponse) {
            throw new UrlNotFound();
        }

        if (200 != $statusResponse) {
            throw new BitlyAPIUnavailable();
        }

        $shortenUrl = json_decode($bodyResponse);

        return $shortenUrl->link;
    }
}
