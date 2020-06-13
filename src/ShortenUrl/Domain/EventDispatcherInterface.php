<?php

declare(strict_types=1);

namespace LaSalle\UrlShortener\MiriamLopez\ShortenUrl\Domain;

use LaSalle\UrlShortener\MiriamLopez\Shared\Domain\UrlNameCreatedDomainEvent;

interface EventDispatcherInterface
{
    public function dispatch(UrlNameCreatedDomainEvent $event): void;
}
