<?php

declare(strict_types=1);

use LaSalle\UrlShortener\MiriamLopez\Shared\Infrastructure\Exceptions\ExceptionToHumanMessage;
use LaSalle\UrlShortener\MiriamLopez\ShortenUrl\ApplicationService\UrlShortenerService;
use LaSalle\UrlShortener\MiriamLopez\ShortenUrl\Infrastructure\BitlyAPIUrlShortenerRepository;
use LaSalle\UrlShortener\MiriamLopez\ShortenUrl\Infrastructure\UrlShortenerCommandController;

require_once '../vendor/autoload.php';


if (isset($argv)) {
    try {
        $url = count($argv) === 1 ? "" : $argv[1];
        $urlShortenerRepository = new BitlyAPIUrlShortenerRepository();
        $urlShortenerService = new UrlShortenerService($urlShortenerRepository);
        $controller = new UrlShortenerCommandController($urlShortenerService);
        echo $controller($url) . "\n";
    } catch (RuntimeException $exception) {
        $exceptionToHumanMessage = new ExceptionToHumanMessage();
        echo $exceptionToHumanMessage->map(get_class($exception)) . '. Error code: ' . $exception->getCode(
        ) . '.' . "\n";
    }

    return;
}
