<?php

declare(strict_types=1);

namespace LaSalle\UrlShortener\MiriamLopez\UrlCounter\ApplicationService;

use LaSalle\UrlShortener\MiriamLopez\Shared\Domain\UrlNameCreatedDomainEvent;

final class IncreaseUrlCounterListener
{

    public function __construct()
    {
    }

    public function increaseUrlCounter(UrlNameCreatedDomainEvent $event)
    {
    }
}
