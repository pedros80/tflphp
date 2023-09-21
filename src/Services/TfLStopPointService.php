<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Services;

use Pedros80\TfLphp\Contracts\StopPointService;
use Pedros80\TfLphp\Exceptions\MethodNotImplemented;
use Pedros80\TfLphp\Services\Service;

final class TfLStopPointService extends Service implements StopPointService
{
    public function getPlacesByIdAndTypes(string $id, array $types = []): array
    {
        $this->validator->isValidNaptan($id);
        $this->validator->isValidStopPointType($types);

        $this->url[] = $id;
        $this->url[] = 'placeTypes';

        $this->params['placeTypes'] = implode(',', $types);

        return $this->get();
    }

    public function getCarParksById(string $id): array
    {
        $this->validator->isValidNaptan($id);

        $this->url[] = $id;
        $this->url[] = 'CarParks';

        return $this->get();
    }

    public function getDisruptedStopPointsByMode(array $modes, bool $includeRouteBlockedStops = false): array
    {
        $this->validator->isValidStopPointMode($modes);

        $this->url[] = 'Mode';
        $this->url[] = $modes;
        $this->url[] = 'Disruption';

        if ($includeRouteBlockedStops) {
            $this->params['includeRouteBlockedStops'] = 'true';
        }

        return $this->get();
    }

    public function getStopPointsById(array $ids, bool $includeCrowdingData = false): array
    {
        $this->validator->isValidNaptan($ids);

        $this->url[] = $ids;

        if ($includeCrowdingData) {
            $this->params['includeCrowdingData'] = 'true';
        }

        return $this->get();
    }

    public function getStopPointsByMode(array $modes, int $page = 1): array
    {
        $this->validator->isValidStopPointMode($modes);

        $this->url[] = 'Mode';
        $this->url[] = $modes;

        $this->params['page'] = $page;

        return $this->get();
    }

    public function searchPointsByRadius(float $lat, float $lng, array $stopTypes, ?int $radius = null, bool $useStopPointHierarchy = false, array $modes = [], array $categories = [], bool $returnLines = false): array
    {
        throw MethodNotImplemented::fromName('StopPointService::searchPointsByRadius');
    }

    public function getTaxiRanksById(string $id): array
    {
        $this->validator->isValidNaptan($id);

        $this->url[] = $id;
        $this->url[] = 'TaxiRanks';

        return $this->get();
    }

    public function getStopPointBySMSCode(string $id): array
    {
        $this->validator->isValidSmsCode($id);

        $this->url[] = 'Sms';
        $this->url[] = $id;

        return $this->get();
    }

    public function getDisruptedStopPointsById(array $ids, bool $getFamily = false, bool $includeRouteBlockedStops = false, bool $flattenResponse = false): array
    {
        $this->validator->isValidNaptan($ids);

        $this->url[] = $ids;
        $this->url[] = 'Disruption';

        if ($getFamily) {
            $this->params['getFamily'] = 'true';

            if ($flattenResponse) {
                $this->params['flattenResponse'] = 'true';
            }
        }

        if ($includeRouteBlockedStops) {
            $this->params['includeRouteBlockedStops'] = 'true';
        }

        return $this->get();
    }

    public function getStopPointsByType(array $types, int $page=0): array
    {
        $this->validator->isValidStopPointType($types);

        $this->url[] = 'Type';
        $this->url[] = $types;

        if ($page) {
            $this->url[] = 'page';
            $this->url[] = $page;
        }

        return $this->get();
    }

    public function getCrowdingDataByIdAndLine(string $id, string $line, string $direction = 'all'): array
    {
        $this->validator->isValidNaptan($id);
        $this->validator->isValidLine($line);
        $this->validator->isValidDirection($direction);

        $this->url[] = $id;
        $this->url[] = 'Crowding';
        $this->url[] = $line;

        $this->params['direction'] = $direction;

        return $this->get();
    }

    public function getReachablePointsFromStopAndLine(string $id, string $line, ?string $serviceTypes = null): array
    {
        $this->validator->isValidNaptan($id);
        $this->validator->isValidLine($line);

        $this->url[] = $id;
        $this->url[] = 'CanReachOnLine';
        $this->url[] = $line;

        if ($serviceTypes) {
            $this->validator->isValidServiceType($serviceTypes);
            $this->params['serviceTypes'] = $serviceTypes;
        }

        return $this->get();
    }

    public function getArrivalAndDepartureById(string $id, array $lines): array
    {
        $this->validator->isValidNaptan($id);
        $this->validator->isValidLine($lines);

        $this->url[] = $id;
        $this->url[] = 'ArrivalDepartures';

        $this->params['lineIds'] = implode(',', $lines);

        return $this->get();
    }

    public function getArrivalsById(string $id): array
    {
        $this->validator->isValidNaptan($id);

        $this->url[] = $id;
        $this->url[] = 'Arrivals';

        return $this->get();
    }

    public function getInformationCategories(): array
    {
        $this->url[] = 'Meta';
        $this->url[] = 'Categories';

        return $this->get();
    }

    public function getModes(): array
    {
        $this->url[] = 'Meta';
        $this->url[] = 'Modes';

        return $this->get();
    }

    public function getTypes(): array
    {
        $this->url[] = 'Meta';
        $this->url[] = 'StopTypes';

        return $this->get();
    }

    public function getServiceTypesFromId(string $id, array $lineIds = [], array $modes = []): array
    {
        $this->url[] = 'ServiceTypes';

        $this->validator->isValidNaptan($id);
        $this->params['id'] = $id;

        if ($lineIds) {
            $this->validator->isValidLine($lineIds);
            $this->params['lineIds'] = implode(',', $lineIds);
        }

        if ($modes) {
            $this->validator->isValidStopPointMode($modes);
            $this->params['modes'] = implode(',', $modes);
        }

        return $this->get();
    }

    public function getDirectionBetweenIds(string $id, string $toStopPointId, ?string $lineId = null): array
    {
        $this->validator->isValidNaptan([$id, $toStopPointId]);

        $this->url[] = $id;
        $this->url[] = 'DirectionTo';
        $this->url[] = $toStopPointId;

        if ($lineId) {
            $this->validator->isValidLine($lineId);
            $this->params['lineId'] = 'lineId';
        }

        return $this->get();
    }

    public function getRouteSectionsById(string $id, array $serviceTypes = []): array
    {
        $this->validator->isValidNaptan($id);

        $this->url[] = $id;
        $this->url[] = 'Route';

        if ($serviceTypes) {
            $this->validator->isValidServiceType($serviceTypes);
            $this->params['serviceTypes'] = implode(',', $serviceTypes);
        }

        return $this->get();
    }

    public function search(string $query, array $modes = [], bool $faresOnly = false, int $maxResults = 0, array $lines = [], bool $includeHubs = false, bool $tflOperatedNationalRailStationsOnly = false): array
    {
        throw MethodNotImplemented::fromName('StopPoint::search()');
    }
}
