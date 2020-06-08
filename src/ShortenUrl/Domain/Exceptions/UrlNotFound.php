<?php

declare(strict_types=1);

namespace LaSalle\UrlShortener\MiriamLopez\ShortenUrl\Domain\Exceptions;

use RuntimeException;

final class UrlNotFound extends RuntimeException
{
    protected $code = 'URL_NOT_FOUND';
}
