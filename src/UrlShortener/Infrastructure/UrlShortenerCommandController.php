<?php

declare(strict_types=1);

namespace LaSalle\UrlShortener\MiriamLopez\UrlShortener\Infrastructure;

use LaSalle\UrlShortener\MiriamLopez\UrlShortener\ApplicationService\UrlShortenerService;

final class UrlShortenerCommandController
{
    private UrlShortenerService $urlShortenerService;

    public function __construct(UrlShortenerService $urlShortenerService)
    {
        $this->urlShortenerService = $urlShortenerService;
    }

    public function __invoke(string $entryUrl)
    {
        return $this->urlShortenerService->__invoke($entryUrl);
    }
}
