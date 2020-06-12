<?php

declare(strict_types=1);

namespace LaSalle\UrlShortener\MiriamLopez\UrlCounter\Infrastructure;

use LaSalle\UrlShortener\MiriamLopez\UrlCounter\ApplicationService\UtmCampaignCounterResponse;
use LaSalle\UrlShortener\MiriamLopez\UrlCounter\ApplicationService\UtmCampaignCounterSearcher;

final class UtmCampaignCounterByClientGetController
{
    private UtmCampaignCounterSearcher $utmCampaignCounterSearcher;

    public function __construct(UtmCampaignCounterSearcher $utmCampaignCounterSearcher)
    {
        $this->utmCampaignCounterSearcher = $utmCampaignCounterSearcher;
    }

    public function __invoke(): string
    {
        $utmCampaignCounterResponse = $this->utmCampaignCounterSearcher->__invoke();

        return $this->formatResponse($utmCampaignCounterResponse);
    }

    private function formatResponse(UtmCampaignCounterResponse $utmCampaignCounterResponse): string
    {
        $result = [
            "total" => $utmCampaignCounterResponse->totalCounter(),
            "utm_campaigns" => []
        ];

        foreach ($utmCampaignCounterResponse->utmCampaignCounter() as $utmCampaign) {
            array_push($result["utm_campaigns"], [$utmCampaign["utmCampaign"] => intval($utmCampaign["count"])]);
        }

        return json_encode($result);
    }
}
