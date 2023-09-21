<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Services;

use Pedros80\TfLphp\Contracts\VehicleService;
use Pedros80\TfLphp\Services\Service;

final class TfLVehicleService extends Service implements VehicleService
{
    public function getPredictions(array $vehicles): array
    {
        $this->url[] = $vehicles;
        $this->url[] = 'Arrivals';

        return $this->get();
    }
}
