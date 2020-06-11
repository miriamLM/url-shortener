<?php

declare(strict_types=1);

namespace LaSalle\UrlShortener\MiriamLopez\UrlCounter\Domain;

interface UrlCounterRepository
{
    public function findByUtmCampaign(UtmCampaign $utmCampaign): ?UtmCampaignCounter;

    public function save(UtmCampaignCounter $utmCampaignCounter): void;
}
