<?php

declare(strict_types=1);

namespace LaSalle\UrlShortener\MiriamLopez\UrlShortener\ApplicationService;

final class ShortUrlRequest
{
    private string $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function value(): string
    {
        return $this->url;
    }
}
