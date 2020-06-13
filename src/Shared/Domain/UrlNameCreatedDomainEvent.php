<?php

declare(strict_types=1);

namespace LaSalle\UrlShortener\MiriamLopez\Shared\Domain;

use Symfony\Contracts\EventDispatcher\Event;

final class UrlNameCreatedDomainEvent extends Event
{
    public const NAME = 'url.name.created.event';

    private string $url;
    private string $utmCampaign;

    public function __construct(string $url, string $utmCampaign)
    {
        $this->url = $url;
        $this->utmCampaign = $utmCampaign;
    }

    public function value(): string
    {
        return $this->url;
    }

    public function utmCampaignValue(): string
    {
        return $this->utmCampaign;
    }
}
