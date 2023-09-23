<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Services;

use Pedros80\TfLphp\Contracts\JourneyService;
use Pedros80\TfLphp\Exceptions\MethodNotImplemented;
use Pedros80\TfLphp\Services\Service;

final class TfLJourneyService extends Service implements JourneyService
{
    public function getAvailableModes(): array
    {
        $this->url[] = 'Meta';
        $this->url[] = 'Modes';

        return $this->get();
    }

    public function search(string $from, string $to, ?string $via=null, bool $nationalSearch = false, ?string $date = null, ?string $time = null, ?string $timeIs = null, ?string $journeyPreference=null, ?array $mode = null, ?string $accessibilityPreference = null, ?string $fromName = null, ?string $toName = null, ?string $viaName = null, ?string $maxTransferMinutes = null, ?string $maxWalkingMinutes = null, ?string $walkingSpeed = null, ?string $cyclePreference = null, ?string $adjustment = null, ?string $bikeProficiency = null, bool $alternativeCycle = false, bool $alternativeWalking = false, bool $applyHtmlMarkup = false, bool $useMultiModalCall = false, bool $walkingOptimization = false, bool $taxiOnlyTrip = false, bool $routeBetweenEntrances = false): array
    {
        // @todo - DTO to sort this mad signature...

        throw MethodNotImplemented::fromName('JourneyService::search');
    }
}
