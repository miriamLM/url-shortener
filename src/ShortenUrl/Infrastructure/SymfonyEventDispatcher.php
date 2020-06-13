<?php

declare(strict_types=1);

namespace LaSalle\UrlShortener\MiriamLopez\ShortenUrl\Infrastructure;

use LaSalle\UrlShortener\MiriamLopez\Shared\Domain\UrlNameCreatedDomainEvent;
use LaSalle\UrlShortener\MiriamLopez\ShortenUrl\Domain\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;

final class SymfonyEventDispatcher implements EventDispatcherInterface
{
    private EventDispatcher $eventDispatcher;

    public function __construct(EventDispatcher $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    public function dispatch(UrlNameCreatedDomainEvent $event): void
    {
        $this->eventDispatcher->dispatch($event, UrlNameCreatedDomainEvent::NAME);
    }
}
