<?php

declare(strict_types=1);

namespace LaSalle\UrlShortener\MiriamLopez\ShortenUrl\Infrastructure;

use LaSalle\UrlShortener\MiriamLopez\ShortenUrl\ApplicationService\ShortUrlRequest;
use LaSalle\UrlShortener\MiriamLopez\ShortenUrl\ApplicationService\UrlShortenerService;

final class UrlShortenerCommandController
{
    private UrlShortenerService $urlShortenerService;

    public function __construct(UrlShortenerService $urlShortenerService)
    {
        $this->urlShortenerService = $urlShortenerService;
    }

    public function __invoke(string $entryUrl)
    {
        $shortUrlRequest = new ShortUrlRequest($entryUrl);
        $shortUrlResponse = $this->urlShortenerService->__invoke($shortUrlRequest);
        return $shortUrlResponse->value();
    }
}
