<?php

declare(strict_types=1);

namespace LaSalle\UrlShortener\MiriamLopez\UrlCounter\Domain;

final class Counter
{
    private int $count;

    public function __construct(int $count)
    {
        $this->count = $count;
    }

    public function value() :int
    {
        return $this->count;
    }
}
