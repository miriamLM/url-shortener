<?php

declare(strict_types=1);

use LaSalle\UrlShortener\MiriamLopez\Shared\Infrastructure\Exceptions\ExceptionToHumanMessage;
use LaSalle\UrlShortener\MiriamLopez\ShortenUrl\ApplicationService\UrlShortenService;
use LaSalle\UrlShortener\MiriamLopez\ShortenUrl\Infrastructure\BitlyAPIUrlShortenerRepository;
use LaSalle\UrlShortener\MiriamLopez\ShortenUrl\Infrastructure\InMemoryShortUrl;
use LaSalle\UrlShortener\MiriamLopez\ShortenUrl\Infrastructure\UrlShortenerCommandController;
use LaSalle\UrlShortener\MiriamLopez\UrlCounter\ApplicationService\UtmCampaignCounterSearcher;
use LaSalle\UrlShortener\MiriamLopez\UrlCounter\Infrastructure\UtmCampaignCounterByClientGetController;

require_once '../vendor/autoload.php';

include("Shared/Public/index.php");

if (isset($argv)) {
    try {
        include("UrlCounter/Public/index.php");

        $url = count($argv) === 1 ? "" : $argv[1];

        $urlShortenerRepository = new BitlyAPIUrlShortenerRepository();

        $inMemoryShortUrl = new InMemoryShortUrl($connectionDB, $urlShortenerRepository);

        $urlShortenService = new UrlShortenService($inMemoryShortUrl, $eventDispatcher);

        $controller = new UrlShortenerCommandController($urlShortenService);
        echo $controller($url) . "\n";
    } catch (RuntimeException $exception) {
        $exceptionToHumanMessage = new ExceptionToHumanMessage();
        echo $exceptionToHumanMessage->map(get_class($exception)) . '. Error code: ' . $exception->getCode(
        ) . '.' . "\n";
    }

    return;
}


$explodeURL = explode("/", $_SERVER['PHP_SELF']);
$routeCounter = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

header("Content-Type: application/json");

if ('/count' === $routeCounter && 'GET' === $requestMethod) {
    $utmCampaignCounterSearcher = new UtmCampaignCounterSearcher($inMemoryUrlCounter);

    $controller = new UtmCampaignCounterByClientGetController($utmCampaignCounterSearcher);
    echo $controller() . "\n";
} else {
    http_response_code(404);
}
