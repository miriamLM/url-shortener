<?php

declare(strict_types=1);

namespace LaSalle\UrlShortener\MiriamLopez\UrlShortener\Domain;

interface UrlShortenerRepository
{
    public function urlShorten(string $entryUrl): string;
}
