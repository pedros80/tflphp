<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Services;

use Pedros80\TfLphp\Contracts\RoadService;
use Pedros80\TfLphp\Exceptions\MethodNotImplemented;
use Pedros80\TfLphp\Services\Service;

final class TfLRoadService extends Service implements RoadService
{
    public function getDisruptionsByRoadId(array $ids, bool $stripContent = false, ?array $severities = null, ?array $categories = null, bool $closures = false): array
    {
        $this->validator->isValidRoadId($ids);

        $this->url[] = $ids;
        $this->url[] = 'Disruption';

        if ($stripContent) {
            $this->params['stripContent'] = 'true';
        }

        if ($severities) {
            $this->validator->isValidRoadDisruptionSeverity($severities);
            $this->params['severities'] = $severities;
        }

        if ($categories) {
            $this->validator->isValidRoadDisruptionCategories($categories);
            $this->params['categories'] = $categories;
        }

        if ($closures) {
            $this->params['closures'] = 'true';
        }

        return $this->get(auth: false);
    }

    public function getDisruptionsById(array $ids, bool $stripContent = false): array
    {
        // api throwing 404 for this endpoint ¯\_(ツ)_/¯
        throw MethodNotImplemented::fromName('RoadService::getDisruptionsById');

        // $this->validator->isValidRoadDisruption($ids);

        // $this->url[] = 'all';
        // $this->url[] = 'Disruption';
        // $this->url[] = $ids;

        // if ($stripContent) {
        //     $this->params['stripContent'] = 'true';
        // }

        // return $this->get();
    }

    public function getDisruptedStreets(?string $startDate = null, ?string $endDate = null): array
    {
        // api throwing 404 for this endpoint ¯\_(ツ)_/¯
        throw MethodNotImplemented::fromName('RoadService::getDisruptedStreets');

        // $this->validator->isValidRFC3339Date([$startDate, $endDate]);

        // $this->url[] = 'all';
        // $this->url[] = 'Street';
        // $this->url[] = 'Disruption';

        // if ($startDate) {
        //     $this->params['startDate'] = $startDate;
        // }

        // if ($endDate) {
        //     $this->params['endDate'] = $endDate;
        // }

        // return $this->get();
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
        $this->validator->isValidRoadId($ids);

        $this->url[] = $ids;

        return $this->get();
    }

    public function getRoadStatus(array $ids, ?string $startDate = null, ?string $endDate = null): array
    {
        $this->validator->isValidRoadId($ids);
        $this->validator->isValidRFC3339Date([$startDate, $endDate]);

        $this->url[] = $ids;
        $this->url[] = 'Status';

        if ($startDate) {
            $this->params['startDate'] = $startDate;
        }

        if ($endDate) {
            $this->params['endDate'] = $endDate;
        }

        return $this->get();
    }
}
