<?php

declare(strict_types=1);

namespace LaSalle\UrlShortener\MiriamLopez\UrlCounter\Domain;

final class UtmCampaign
{
    private string $utmCampaign;

    public function __construct(string $utmCampaign)
    {
        $this->utmCampaign = $utmCampaign;
    }

    public function value(): string
    {
        return $this->utmCampaign;
    }
}
