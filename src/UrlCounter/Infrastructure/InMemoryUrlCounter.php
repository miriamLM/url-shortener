<?php

declare(strict_types=1);

namespace LaSalle\UrlShortener\MiriamLopez\UrlCounter\Infrastructure;

use LaSalle\UrlShortener\MiriamLopez\Shared\Infrastructure\UrlShortenerDBConnection;
use LaSalle\UrlShortener\MiriamLopez\UrlCounter\Domain\UrlCounterRepository;
use LaSalle\UrlShortener\MiriamLopez\UrlCounter\Domain\UtmCampaign;
use LaSalle\UrlShortener\MiriamLopez\UrlCounter\Domain\UtmCampaignCounter;

final class InMemoryUrlCounter implements UrlCounterRepository
{
    private UrlShortenerDBConnection $connectionDB;

    public function __construct(UrlShortenerDBConnection $connectionDB)
    {
        $this->connectionDB = $connectionDB;
    }

    public function findByUtmCampaign(UtmCampaign $utmCampaign): ?UtmCampaignCounter
    {
    }

    public function save(UtmCampaignCounter $utmCampaignCounter): void
    {
    }
}
