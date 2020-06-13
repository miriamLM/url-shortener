<?php

use LaSalle\UrlShortener\MiriamLopez\ShortenUrl\Infrastructure\SymfonyEventDispatcher;
use LaSalle\UrlShortener\MiriamLopez\UrlCounter\ApplicationService\IncreaseUrlCounterListener;
use LaSalle\UrlShortener\MiriamLopez\UrlCounter\Infrastructure\InMemoryUrlCounter;
use Symfony\Component\EventDispatcher\EventDispatcher;

$dispatcher = new EventDispatcher();

$inMemoryUrlCounter = new InMemoryUrlCounter($connectionDB);

$eventDispatcher = new SymfonyEventDispatcher($dispatcher);

$listener = new IncreaseUrlCounterListener($inMemoryUrlCounter);
$dispatcher->addListener('url.name.created.event', array($listener, 'increaseUrlCounter'));
