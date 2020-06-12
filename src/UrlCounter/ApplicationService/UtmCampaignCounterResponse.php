<?php

declare(strict_types=1);

namespace LaSalle\UrlShortener\MiriamLopez\UrlCounter\ApplicationService;

use LaSalle\UrlShortener\MiriamLopez\UrlCounter\Domain\Counter;

final class UtmCampaignCounterResponse
{
    private Counter $totalCounter;
    private array $utmCampaignCounter;

    public function __construct(Counter $totalCounter, array $utmCampaignCounter)
    {
        $this->totalCounter = $totalCounter;
        $this->utmCampaignCounter = $utmCampaignCounter;
    }

    public function totalCounter(): Counter
    {
        return $this->totalCounter;
    }

    public function utmCampaignCounter(): array
    {
        return $this->utmCampaignCounter;
    }
}
