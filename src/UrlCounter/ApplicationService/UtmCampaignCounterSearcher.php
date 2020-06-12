<?php

declare(strict_types=1);

namespace LaSalle\UrlShortener\MiriamLopez\UrlCounter\ApplicationService;

use LaSalle\UrlShortener\MiriamLopez\UrlCounter\Domain\UrlCounterRepository;

final class UtmCampaignCounterSearcher
{
    private UrlCounterRepository $urlCounterRepository;

    public function __construct(UrlCounterRepository $urlCounterRepository)
    {
        $this->urlCounterRepository = $urlCounterRepository;
    }

    public function __invoke(): ?UtmCampaignCounterResponse
    {
        $totalCount = $this->urlCounterRepository->findTotalCount();
        if (0 === $totalCount) {
            return null;
        }
        $utmCampaignArray = $this->urlCounterRepository->findUtmCampaigns();

        return new UtmCampaignCounterResponse($totalCount, $utmCampaignArray);
    }
}
