<?php

declare(strict_types=1);

namespace LaSalle\UrlShortener\MiriamLopez\UrlCounter\ApplicationService;

use LaSalle\UrlShortener\MiriamLopez\Shared\Domain\UrlNameCreatedDomainEvent;
use LaSalle\UrlShortener\MiriamLopez\UrlCounter\Domain\Counter;
use LaSalle\UrlShortener\MiriamLopez\UrlCounter\Domain\UrlCounterRepository;
use LaSalle\UrlShortener\MiriamLopez\UrlCounter\Domain\UtmCampaign;
use LaSalle\UrlShortener\MiriamLopez\UrlCounter\Domain\UtmCampaignCounter;

final class IncreaseUrlCounterListener
{
    private UrlCounterRepository $urlCounterRepository;

    public function __construct(UrlCounterRepository $urlCounterRepository)
    {
        $this->urlCounterRepository = $urlCounterRepository;
    }

    public function increaseUrlCounter(UrlNameCreatedDomainEvent $event)
    {
        $utmCampign = new UtmCampaign($event->utmCampaignValue());
        $utmCampaignCounter = $this->urlCounterRepository->findByUtmCampaign($utmCampign);

        if (null === $utmCampaignCounter) {
            $utmCampaignCounter = new UtmCampaignCounter($utmCampign, new Counter(0));
        }
    }
}
