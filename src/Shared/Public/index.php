<?php

use LaSalle\UrlShortener\MiriamLopez\Shared\Infrastructure\UrlShortenerDBConnection;
use LaSalle\UrlShortener\MiriamLopez\UrlCounter\Infrastructure\InMemoryUrlCounter;

$connectionDB = new UrlShortenerDBConnection();

$inMemoryUrlCounter = new InMemoryUrlCounter($connectionDB);
