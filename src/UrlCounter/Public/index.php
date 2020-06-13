<?php

use LaSalle\UrlShortener\MiriamLopez\ShortenUrl\Infrastructure\SymfonyEventDispatcher;
use LaSalle\UrlShortener\MiriamLopez\UrlCounter\ApplicationService\IncreaseUrlCounterListener;
use Symfony\Component\EventDispatcher\EventDispatcher;

$dispatcher = new EventDispatcher();

$eventDispatcher = new SymfonyEventDispatcher($dispatcher);

$listener = new IncreaseUrlCounterListener($inMemoryUrlCounter);
$dispatcher->addListener('url.name.created.event', array($listener, 'increaseUrlCounter'));
