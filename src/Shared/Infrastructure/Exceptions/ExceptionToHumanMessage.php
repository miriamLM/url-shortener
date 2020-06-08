<?php

declare(strict_types=1);

namespace LaSalle\UrlShortener\MiriamLopez\Shared\Infrastructure\Exceptions;

use LaSalle\UrlShortener\MiriamLopez\ShortenUrl\Domain\Exceptions\EmptyUrl;
use LaSalle\UrlShortener\MiriamLopez\ShortenUrl\Domain\Exceptions\UrlNotFound;
use LaSalle\UrlShortener\MiriamLopez\ShortenUrl\Infrastructure\Exceptions\BitlyAPIUnavailable;

final class ExceptionToHumanMessage
{
    private array $exceptionToHumanMessage = [
        EmptyUrl::class => 'Url is empty',
        UrlNotFound::class => 'Url not found',
        BitlyAPIUnavailable::class => 'Bitly API is not avilable'
    ];

    public function map(string $exceptionClass): string
    {
        if (!array_key_exists($exceptionClass, $this->exceptionToHumanMessage)) {
            return 'Unknown error';
        }
        return $this->exceptionToHumanMessage[$exceptionClass];
    }
}
