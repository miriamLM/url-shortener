<?php

declare(strict_types=1);

namespace LaSalle\UrlShortener\MiriamLopez\ShortenUrl\Infrastructure;

use LaSalle\UrlShortener\MiriamLopez\ShortenUrl\ApplicationService\ShortUrlRequest;
use LaSalle\UrlShortener\MiriamLopez\ShortenUrl\ApplicationService\ShortenUrlService;

final class UrlShortenerCommandController
{
    private ShortenUrlService $urlShortenerService;

    public function __construct(ShortenUrlService $urlShortenerService)
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
