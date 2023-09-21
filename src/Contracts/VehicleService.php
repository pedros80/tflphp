<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Contracts;

interface VehicleService
{
    /**
     * Gets the predictions for a given list of vehicle IDs
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=Vehicle&operation=Vehicle_GetByPathIds
     */
    public function getPredictions(array $vehicles): array;
}
