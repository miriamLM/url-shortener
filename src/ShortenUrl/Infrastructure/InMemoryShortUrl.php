<?php

declare(strict_types=1);

namespace LaSalle\UrlShortener\MiriamLopez\ShortenUrl\Infrastructure;

use LaSalle\UrlShortener\MiriamLopez\Shared\Infrastructure\UrlShortenerDBConnection;
use LaSalle\UrlShortener\MiriamLopez\ShortenUrl\Domain\UrlName;
use LaSalle\UrlShortener\MiriamLopez\ShortenUrl\Domain\UrlShortenerRepository;

final class InMemoryShortUrl implements UrlShortenerRepository
{
    private UrlShortenerDBConnection $connectionDB;
    private BitlyAPIUrlShortenerRepository $bitlyAPIUrlShortenerRepository;

    public function __construct(
        UrlShortenerDBConnection $connectionDB,
        BitlyAPIUrlShortenerRepository $bitlyAPIUrlShortenerRepository
    ) {
        $this->connectionDB = $connectionDB;
        $this->bitlyAPIUrlShortenerRepository = $bitlyAPIUrlShortenerRepository;
    }

    public function urlShorten(UrlName $url): string
    {
        $shortUrlFromBD = $this->findShortUrlInBD($url);
        if (null !== $shortUrlFromBD) {
            return $shortUrlFromBD;
        }
        $shortUrl = $this->bitlyAPIUrlShortenerRepository->urlShorten($url);

        $this->saveInBD($url, $shortUrl);

        return $shortUrl;
    }

    public function findShortUrlInBD(UrlName $originalUrl): ?string
    {
        $stmt = $this->connectionDB->pdo()->prepare(
            'SELECT shortUrl FROM shortUrl where originalUrl = :originalUrl'
        );
        $stmt->bindValue("originalUrl", $originalUrl->value());
        $stmt->execute();
        $shortUrl = $stmt->fetchColumn();
        return $shortUrl === false ? null : $shortUrl;
    }

    public function saveInBD(UrlName $originalUrl, string $shortUrl)
    {
        $stmt = $this->connectionDB->pdo()->prepare(
            'INSERT IGNORE INTO shortUrl(originalUrl, shortUrl, utmCampaign) VALUES (:originalUrl, :shortUrl, :utmCampaign)'
        );
        $stmt->bindValue("originalUrl", $originalUrl->value());
        $stmt->bindValue("shortUrl", $shortUrl);
        $stmt->bindValue("utmCampaign", $originalUrl->utmCampaignValue());
        $stmt->execute();
    }
}
