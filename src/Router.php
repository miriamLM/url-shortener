<?php

declare(strict_types=1);

use LaSalle\UrlShortener\MiriamLopez\Shared\Infrastructure\Exceptions\ExceptionToHumanMessage;
use LaSalle\UrlShortener\MiriamLopez\Shared\Infrastructure\UrlShortenerDBConnection;
use LaSalle\UrlShortener\MiriamLopez\ShortenUrl\ApplicationService\UrlShortenService;
use LaSalle\UrlShortener\MiriamLopez\ShortenUrl\Infrastructure\BitlyAPIUrlShortenerRepository;
use LaSalle\UrlShortener\MiriamLopez\ShortenUrl\Infrastructure\InMemoryShortUrl;
use LaSalle\UrlShortener\MiriamLopez\ShortenUrl\Infrastructure\SymfonyEventDispatcher;
use LaSalle\UrlShortener\MiriamLopez\ShortenUrl\Infrastructure\UrlShortenerCommandController;
use LaSalle\UrlShortener\MiriamLopez\UrlCounter\ApplicationService\IncreaseUrlCounterListener;
use LaSalle\UrlShortener\MiriamLopez\UrlCounter\ApplicationService\UtmCampaignCounterSearcher;
use LaSalle\UrlShortener\MiriamLopez\UrlCounter\Domain\UrlCounterRepository;
use LaSalle\UrlShortener\MiriamLopez\UrlCounter\Infrastructure\InMemoryUrlCounter;
use LaSalle\UrlShortener\MiriamLopez\UrlCounter\Infrastructure\UtmCampaignCounterByClientGetController;
use Symfony\Component\EventDispatcher\EventDispatcher;

require_once '../vendor/autoload.php';

$connectionDB = new UrlShortenerDBConnection();

if (isset($argv)) {
    try {
        $url = count($argv) === 1 ? "" : $argv[1];

        $urlShortenerRepository = new BitlyAPIUrlShortenerRepository();

        $inMemoryShortUrl = new InMemoryShortUrl($connectionDB, $urlShortenerRepository);

        $dispatcher = new EventDispatcher();

        $inMemoryUrlCounter = new InMemoryUrlCounter($connectionDB);

        $eventDispatcher = new SymfonyEventDispatcher($dispatcher);

        $listener = new IncreaseUrlCounterListener($inMemoryUrlCounter);
        $dispatcher->addListener('url.name.created.event', array($listener, 'increaseUrlCounter'));

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
    $inMemoryUrlCounter = new InMemoryUrlCounter($connectionDB);
    $utmCampaignCounterSearcher = new UtmCampaignCounterSearcher($inMemoryUrlCounter);
    $controller = new UtmCampaignCounterByClientGetController($utmCampaignCounterSearcher);
    echo $controller() ."\n";
}
