<?php

declare(strict_types=1);

namespace LaSalle\UrlShortener\MiriamLopez\ShortenUrl\Domain;

use LaSalle\UrlShortener\MiriamLopez\ShortenUrl\Domain\Exceptions\EmptyUrl;

final class UrlName
{
    private string $url;
    private string $utmCampaign;

    public function __construct(string $url)
    {
        $this->url = $url;
        $this->checkUrlValid();
        $this->checkUtmCampaign();
    }

    private function checkUrlValid(): void
    {
        if (!isset($this->url) || $this->url === '') {
            throw new EmptyUrl();
        }
    }

    private function checkUtmCampaign(): void
    {
        $utmArray = explode('&', $this->url);

        foreach ($utmArray as $utm) {
            $pos = strpos($utm, 'utm_campaign');

            if (0 === $pos) {
                $utmCampaignArray = explode('=', $utm);

                $this->utmCampaign = $utmCampaignArray[1];
                return;
            }
        }
        $this->utmCampaign = '';
    }

    public function value(): string
    {
        return $this->url;
    }

    public function utmCampaignValue(): string
    {
        return $this->utmCampaign;
    }
}
