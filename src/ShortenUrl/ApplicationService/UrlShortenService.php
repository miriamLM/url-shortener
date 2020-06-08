<?php

declare(strict_types=1);

namespace LaSalle\UrlShortener\MiriamLopez\ShortenUrl\ApplicationService;

use LaSalle\UrlShortener\MiriamLopez\ShortenUrl\Domain\UrlName;
use LaSalle\UrlShortener\MiriamLopez\ShortenUrl\Domain\ShortenUrlRepository;

final class UrlShortenService
{
    private ShortenUrlRepository $urlShortenerRepository;

    public function __construct(ShortenUrlRepository $urlShortenerRepository)
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
