<?php

declare(strict_types=1);

namespace LaSalle\UrlShortener\MiriamLopez\UrlShortener\Domain;

use LaSalle\UrlShortener\MiriamLopez\UrlShortener\Domain\Exceptions\EmptyUrl;

final class UrlName
{
    private string $url;

    public function __construct(string $url)
    {
        $this->url = $url;
        $this->checkUrlValid();
    }

    public function value(): string
    {
        return $this->url;
    }

    public function checkUrlValid()
    {
        if (!isset($this->url) || $this->url === '') {
            throw new EmptyUrl();
        }
    }
}
