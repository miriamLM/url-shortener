<?php

declare(strict_types=1);

namespace LaSalle\UrlShortener\MiriamLopez\UrlShortener\Infrastructure\Exceptions;

use RuntimeException;

final class BitlyAPIUnavailable extends RuntimeException
{
    protected $code = 'BITLY_API_UNAVAILABLE';
}
