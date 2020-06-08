<?php

declare(strict_types=1);

namespace LaSalle\UrlShortener\MiriamLopez\UrlShortener\Domain\Exceptions;

use RuntimeException;

final class EmptyUrl extends RuntimeException
{
    protected $code = 'EMPTY_URL';
}
