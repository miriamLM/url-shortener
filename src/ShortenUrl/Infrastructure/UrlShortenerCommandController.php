<?php

declare(strict_types=1);

namespace LaSalle\UrlShortener\MiriamLopez\ShortenUrl\Infrastructure;

use LaSalle\UrlShortener\MiriamLopez\ShortenUrl\ApplicationService\ShortUrlRequest;
use LaSalle\UrlShortener\MiriamLopez\ShortenUrl\ApplicationService\UrlShortenService;

final class UrlShortenerCommandController
{
    private UrlShortenService $shortenUrlService;

    public function __construct(UrlShortenService $shortenUrlService)
    {
        $this->shortenUrlService = $shortenUrlService;
    }

    public function __invoke(string $entryUrl): string
    {
        $shortUrlRequest = new ShortUrlRequest($entryUrl);
        $shortUrlResponse = $this->shortenUrlService->__invoke($shortUrlRequest);
        return $shortUrlResponse->value();
    }
}
