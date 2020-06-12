<?php

declare(strict_types=1);

namespace LaSalle\UrlShortener\MiriamLopez\UrlCounter\Infrastructure;

use LaSalle\UrlShortener\MiriamLopez\UrlCounter\ApplicationService\UtmCampaignCounterSearcher;

final class UtmCampaignCounterByClientGetController
{
    private UtmCampaignCounterSearcher $utmCampaignCounterSearcher;

    public function __construct(UtmCampaignCounterSearcher $utmCampaignCounterSearcher)
    {
        $this->utmCampaignCounterSearcher = $utmCampaignCounterSearcher;
    }

    public function __invoke()
    {
        $this->utmCampaignCounterSearcher->__invoke();
    }
}
