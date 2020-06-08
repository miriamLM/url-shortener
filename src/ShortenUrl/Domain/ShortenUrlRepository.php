<?php

declare(strict_types=1);

namespace LaSalle\UrlShortener\MiriamLopez\ShortenUrl\Domain;

interface ShortenUrlRepository
{
    public function urlShorten(UrlName $url): string;
}
