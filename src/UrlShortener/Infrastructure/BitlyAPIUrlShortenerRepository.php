<?php

declare(strict_types=1);

namespace LaSalle\UrlShortener\MiriamLopez\UrlShortener\Infrastructure;

use LaSalle\UrlShortener\MiriamLopez\UrlShortener\Domain\UrlShortenerRepository;

final class BitlyAPIUrlShortenerRepository implements UrlShortenerRepository
{

    public function urlShorten(string $entryUrl): string
    {
    }
}
