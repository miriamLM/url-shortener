<?php

declare(strict_types=1);

namespace LaSalle\UrlShortener\MiriamLopez\UrlShortener\ApplicationService;

use LaSalle\UrlShortener\MiriamLopez\UrlShortener\Domain\UrlShortenerRepository;

final class UrlShortenerService
{
    private UrlShortenerRepository $urlShortenerRepository;

    public function __construct(UrlShortenerRepository $urlShortenerRepository)
    {
        $this->urlShortenerRepository = $urlShortenerRepository;
    }

    public function __invoke(string $entryUrl): string
    {
        return $this->urlShortenerRepository->urlShorten($entryUrl);
    }
}
