<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Services;

use Pedros80\TfLphp\Contracts\RoadService;
use Pedros80\TfLphp\Exceptions\MethodNotImplemented;
use Pedros80\TfLphp\Services\Service;

final class TfLRoadService extends Service implements RoadService
{
    public function getDisruptionsByRoadId(string $ids, bool $stripContent = false, ?array $severities = null, ?array $categories = null, bool $closures = false): array
    {
        throw MethodNotImplemented::fromName('RoadService::getDisruptionByRoadId');
    }

    public function getDisruptionsById(array $ids, bool $stripContent = false): array
    {
        throw MethodNotImplemented::fromName('RoadService::getDisruptionsById');
    }

    public function getDisruptedStreets(?string $startDate = null, ?string $endDate = null): array
    {
        throw MethodNotImplemented::fromName('RoadService::getDisruptedStreets');
    }

    public function getDisruptionCategories(): array
    {
        $this->url[] = 'Meta';
        $this->url[] = 'Categories';

        return $this->get();
    }

    public function getDisruptionSeverities(): array
    {
        $this->url[] = 'Meta';
        $this->url[] = 'Severities';

        return $this->get();
    }

    public function getRoadsManagedByTfL(): array
    {
        return $this->get();
    }

    public function getRoadById(array $ids): array
    {
        throw MethodNotImplemented::fromName('RoadService::getRoadById');
    }

    public function getRoadStatus(array $ids, ?string $startDate = null, ?string $endDate = null): array
    {
        throw MethodNotImplemented::fromName('RoadService::getRoadStatus');
    }
}
