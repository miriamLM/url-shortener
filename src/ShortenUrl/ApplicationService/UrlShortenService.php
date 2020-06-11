<?php

declare(strict_types=1);

namespace LaSalle\UrlShortener\MiriamLopez\ShortenUrl\ApplicationService;

use LaSalle\UrlShortener\MiriamLopez\Shared\Domain\UrlNameCreatedDomainEvent;
use LaSalle\UrlShortener\MiriamLopez\ShortenUrl\Domain\EventDispatcherInterface;
use LaSalle\UrlShortener\MiriamLopez\ShortenUrl\Domain\UrlName;
use LaSalle\UrlShortener\MiriamLopez\ShortenUrl\Domain\UrlShortenerRepository;

final class UrlShortenService
{
    private UrlShortenerRepository $urlShortenerRepository;
    private EventDispatcherInterface $eventDispatcher;

    public function __construct(
        UrlShortenerRepository $urlShortenerRepository,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->urlShortenerRepository = $urlShortenerRepository;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function __invoke(ShortUrlRequest $shortUrlRequest): ShortUrlResponse
    {
        $url = new UrlName($shortUrlRequest->value());

        $shortUrl = $this->urlShortenerRepository->urlShorten($url);

        $event = new UrlNameCreatedDomainEvent($url->value(), $url->utmCampaignValue());

        return new ShortUrlResponse($shortUrl);
    }
}
