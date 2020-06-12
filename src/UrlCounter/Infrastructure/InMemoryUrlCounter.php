<?php

declare(strict_types=1);

namespace LaSalle\UrlShortener\MiriamLopez\UrlCounter\Infrastructure;

use LaSalle\UrlShortener\MiriamLopez\Shared\Infrastructure\UrlShortenerDBConnection;
use LaSalle\UrlShortener\MiriamLopez\UrlCounter\Domain\Counter;
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

    public function save(UtmCampaignCounter $utmCampaignCounter): void
    {
        $utmCampaign = $this->findByUtmCampaign($utmCampaignCounter->utmCampaign());

        if (null === $utmCampaign) {
            $stmt = $this->connectionDB->pdo()->prepare(
                'INSERT IGNORE INTO urlCounter(utmCampaign, count) VALUES (:utmCampaign, :count)'
            );
        } else {
            $stmt = $this->connectionDB->pdo()->prepare(
                'UPDATE urlCounter SET count = :count WHERE utmCampaign = :utmCampaign'
            );
        }

        $stmt->bindValue("utmCampaign", $utmCampaignCounter->utmCampaign()->value());
        $stmt->bindValue("count", $utmCampaignCounter->counter()->value());

        $stmt->execute();
    }

    public function findByUtmCampaign(UtmCampaign $utmCampaign): ?UtmCampaignCounter
    {
        $stmt = $this->connectionDB->pdo()->prepare(
            'SELECT utmCampaign, count FROM urlCounter where utmCampaign = :utmCampaign'
        );

        $stmt->bindValue("utmCampaign", $utmCampaign->value());
        $stmt->execute();

        $utmCampaignResult = $stmt->fetch();

        return $utmCampaignResult === false ? null : new UtmCampaignCounter(
            new UtmCampaign($utmCampaignResult['utmCampaign']),
            new Counter(intval($utmCampaignResult['count']))
        );
    }

    public function findUtmCampaigns(): ?array
    {
        $stmt = $this->connectionDB->pdo()->prepare(
            'SELECT utmCampaign, count FROM urlCounter WHERE utmCampaign NOT LIKE ""'
        );
        $stmt->execute();

        return $stmt->fetchALl();
    }

    public function findTotalCount(): int
    {
        $stmt = $this->connectionDB->pdo()->prepare(
            'SELECT SUM(count) FROM urlCounter'
        );
        $stmt->execute();

        $count = $stmt->fetchColumn();

        return intval($count);
    }
}
