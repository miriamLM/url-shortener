<?php

declare(strict_types=1);

namespace LaSalle\UrlShortener\MiriamLopez\ShortenUrl\Infrastructure;

use LaSalle\UrlShortener\MiriamLopez\ShortenUrl\Domain\UrlName;
use LaSalle\UrlShortener\MiriamLopez\ShortenUrl\Domain\UrlShortenerRepository;

final class InMemoryShortUrl implements UrlShortenerRepository
{

    public function urlShorten(UrlName $url): string
    {
    }
}
