<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Services;

use Pedros80\TfLphp\Contracts\OccupancyService;
use Pedros80\TfLphp\Services\Service;

final class TfLOccupancyService extends Service implements OccupancyService
{
    public function getOccupancyForBikePoint(string $id): array
    {
        $this->validator->isValidBikePointId($id);

        $this->url[] = 'BikePoints';
        $this->url[] = $id;

        return $this->get();
    }

    public function getOccupancyForCarPark(string $id): array
    {
        $this->validator->isValidCarParkId($id);

        $this->url[] = 'CarPark';
        $this->url[] = $id;

        return $this->get();
    }

    public function getOccupancyForAllCarParks(): array
    {
        $this->url[] = 'CarPark';

        return $this->get();
    }

    public function getOccupancyForChargeConnector(string $id): array
    {
        $this->url[] = 'ChargeConnector';
        $this->url[] = $id;

        return $this->get();
    }

    public function getOccupancyForAllChargeConnectors(): array
    {
        $this->url[] = 'ChargeConnector';

        return $this->get();
    }
}
