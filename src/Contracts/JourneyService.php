<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Contracts;

interface JourneyService
{
    /**
     * Gets a list of all of the available journey planner modes
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=Journey&operation=Journey_Meta
     */
    public function getAvailableModes(): array;

    /**
     * Perform a Journey Planner search from the parameters specified in simple types
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=Journey&operation=Journey_JourneyResultsByPathFromPathToQueryViaQueryNationalSearchQueryDateQu
     */
    public function search(
        string $from,
        string $to,
        ?string $via,
        bool $nationalSearch=false,
        ?string $date=null,
        ?string $time=null,
        ?string $timeIs=null,
        ?string $journeyPreference=null,
        ?array $mode=null,
        ?string $accessibilityPreference=null,
        ?string $fromName=null,
        ?string $toName=null,
        ?string $viaName=null,
        ?string $maxTransferMinutes=null,
        ?string $maxWalkingMinutes=null,
        ?string $walkingSpeed=null,
        ?string $cyclePreference=null,
        ?string $adjustment=null,
        ?string $bikeProficiency=null,
        bool $alternativeCycle=false,
        bool $alternativeWalking=false,
        bool $applyHtmlMarkup=false,
        bool $useMultiModalCall=false,
        bool $walkingOptimization=false,
        bool $taxiOnlyTrip=false,
        bool $routeBetweenEntrances=false
    ): array;
}
