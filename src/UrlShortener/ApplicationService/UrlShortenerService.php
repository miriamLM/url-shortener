<?php

declare(strict_types=1);

namespace LaSalle\UrlShortener\MiriamLopez\UrlShortener\ApplicationService;

use LaSalle\UrlShortener\MiriamLopez\UrlShortener\Domain\UrlName;
use LaSalle\UrlShortener\MiriamLopez\UrlShortener\Domain\UrlShortenerRepository;

final class UrlShortenerService
{
    private UrlShortenerRepository $urlShortenerRepository;

    public function __construct(UrlShortenerRepository $urlShortenerRepository)
    {
        $this->urlShortenerRepository = $urlShortenerRepository;
    }

    public function __invoke(ShortUrlRequest $shortUrlRequest): ShortUrlResponse
    {
        $url = new UrlName($shortUrlRequest->value());

        $shortUrl = $this->urlShortenerRepository->urlShorten($url);

        $shortUrlResponse = new ShortUrlResponse($shortUrl);
        return $shortUrlResponse;
    }
}
