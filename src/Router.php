<?php

declare(strict_types=1);

use LaSalle\UrlShortener\MiriamLopez\UrlShortener\ApplicationService\UrlShortenerService;
use LaSalle\UrlShortener\MiriamLopez\UrlShortener\Infrastructure\BitlyAPIUrlShortenerRepository;
use LaSalle\UrlShortener\MiriamLopez\UrlShortener\Infrastructure\UrlShortenerCommandController;

require_once '../vendor/autoload.php';


if (isset($argv)) {
    try {
        $url = count($argv) === 1 ? "" : $argv[1];
        $urlShortenerRepository = new BitlyAPIUrlShortenerRepository();
        $urlShortenerService = new UrlShortenerService($urlShortenerRepository);
        $controller = new UrlShortenerCommandController($urlShortenerService);
        echo $controller($url) . "\n";
    } catch (RuntimeException $exception) {
        throw new Exception();
    }
    return;
}
