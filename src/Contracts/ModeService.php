<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Contracts;

interface ModeService
{
    /**
     * Gets the next arrival predictions for all stops of a given mode
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=Mode&operation=Mode_Arrivals
     */
    public function getArrivalPredictions(string $mode, int $count): array;

    /**
     * Returns the service type active for a mode
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=Mode&operation=Mode_GetActiveServiceTypes
     */
    public function getActiveServiceType(): array;
}
