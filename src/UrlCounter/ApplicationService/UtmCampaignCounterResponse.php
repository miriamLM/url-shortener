<?php

declare(strict_types=1);

namespace LaSalle\UrlShortener\MiriamLopez\UrlCounter\ApplicationService;

final class UtmCampaignCounterResponse
{
    private int $totalCounter;
    private array $utmCampaignCounter;

    public function __construct(int $totalCounter, array $utmCampaignCounter)
    {
        $this->totalCounter = $totalCounter;
        $this->utmCampaignCounter = $utmCampaignCounter;
    }

    public function totalCounter(): int
    {
        return $this->totalCounter;
    }

    public function utmCampaignCounter(): array
    {
        return $this->utmCampaignCounter;
    }
}
