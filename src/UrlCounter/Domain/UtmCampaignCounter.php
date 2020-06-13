<?php

declare(strict_types=1);

namespace LaSalle\UrlShortener\MiriamLopez\UrlCounter\Domain;

final class UtmCampaignCounter
{
    private UtmCampaign $utmCampaign;
    private Counter $counter;

    public function __construct(UtmCampaign $utmCampaign, Counter $counter)
    {
        $this->utmCampaign = $utmCampaign;
        $this->counter = $counter;
    }

    public function utmCampaign(): UtmCampaign
    {
        return $this->utmCampaign;
    }

    public function counter(): Counter
    {
        return $this->counter;
    }

    private function count(): Counter
    {
        return new Counter($this->counter->value());
    }

    public function increase(): self
    {
        return new self($this->utmCampaign, $this->count()->increment());
    }
}
