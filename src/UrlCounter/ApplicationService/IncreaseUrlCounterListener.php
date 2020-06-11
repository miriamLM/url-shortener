<?php

declare(strict_types=1);

namespace LaSalle\UrlShortener\MiriamLopez\UrlCounter\ApplicationService;

use LaSalle\UrlShortener\MiriamLopez\Shared\Domain\UrlNameCreatedDomainEvent;
use LaSalle\UrlShortener\MiriamLopez\UrlCounter\Domain\UrlCounterRepository;

final class IncreaseUrlCounterListener
{
    private UrlCounterRepository $urlCounterRepository;

    public function __construct(UrlCounterRepository $urlCounterRepository)
    {
        $this->urlCounterRepository = $urlCounterRepository;
    }

    public function increaseUrlCounter(UrlNameCreatedDomainEvent $event)
    {
    }
}
