<?php

declare(strict_types=1);

namespace LaSalle\UrlShortener\MiriamLopez\ShortenUrl\Infrastructure;

use LaSalle\UrlShortener\MiriamLopez\Shared\Infrastructure\UrlShortenerDBConnection;
use LaSalle\UrlShortener\MiriamLopez\ShortenUrl\Domain\UrlName;
use LaSalle\UrlShortener\MiriamLopez\ShortenUrl\Domain\UrlShortenerRepository;

final class InMemoryShortUrl implements UrlShortenerRepository
{
    private UrlShortenerDBConnection $connectionDB;
    private BitlyAPIUrlShortenerRepository $bitlyAPIUrlShortenerRepository;

    public function __construct(
        UrlShortenerDBConnection $connectionDB,
        BitlyAPIUrlShortenerRepository $bitlyAPIUrlShortenerRepository
    ) {
        $this->connectionDB = $connectionDB;
        $this->bitlyAPIUrlShortenerRepository = $bitlyAPIUrlShortenerRepository;
    }


    public function urlShorten(UrlName $url): string
    {
    }
}
