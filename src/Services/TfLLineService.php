<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Services;

use Pedros80\TfLphp\Contracts\LineService;
use Pedros80\TfLphp\Exceptions\MethodNotImplemented;
use Pedros80\TfLphp\Services\Service;

final class TfLLineService extends Service implements LineService
{
    public function getRoutes(array $lines = [], bool $night = false): array
    {
        if ($lines) {
            $this->validator->isValidLine($lines);
            $this->url[] = $lines;
        }
        $this->url[] = 'Route';

        if ($night) {
            $this->params['serviceTypes'] = 'Night';
        }

        return $this->get();
    }

    public function getDisruptionsForAllLines(array $modes): array
    {
        $this->validator->isValidLineMode($modes);

        $this->url[] = 'Mode';
        $this->url[] = $modes;
        $this->url[] = 'Disruption';

        return $this->get(
            auth: false
        );
    }

    public function getDisruptionsForLines(array $lines): array
    {
        $this->validator->isValidLine($lines);

        $this->url[] = $lines;
        $this->url[] = 'Disruption';

        return $this->get(
            auth: false
        );
    }

    public function getArrivalsByLine(array $routes): array
    {
        $this->validator->isValidLine($routes);

        $this->url[] = $routes;
        $this->url[] = 'Arrivals';

        return $this->get();
    }

    public function getArrivalsByLineAndStop(array $routes, string $stopPointId, ?string $direction = null, ?string $destinationStationId = null): array
    {
        $this->validator->isValidLine($routes);

        $this->url[] = $routes;
        $this->url[] = 'Arrivals';
        $this->url[] = $stopPointId;

        if ($direction) {
            $this->validator->isValidDirection($direction);
            $this->params['direction'] = $direction;
        }

        if ($destinationStationId) {
            $this->params['destinationStationId'] = $destinationStationId;
        }

        return $this->get();
    }

    public function getServingStations(string $line, bool $tflOperatedNationalRailStationsOnly = false): array
    {
        $this->validator->isValidLine($line);

        $this->url[] = $line;
        $this->url[] = 'StopPoints';

        if ($tflOperatedNationalRailStationsOnly) {
            $this->params['tflOperatedNationalRailStationsOnly'] = 'true';
        }

        return $this->get();
    }

    public function getDisruptionCategories(): array
    {
        $this->url[] = 'Meta';
        $this->url[] = 'DisruptionCategories';

        return $this->get();
    }

    public function getModes(): array
    {
        $this->url[] = 'Meta';
        $this->url[] = 'Modes';

        return $this->get();
    }

    public function getServiceTypes(): array
    {
        $this->url[] = 'Meta';
        $this->url[] = 'ServiceTypes';

        return $this->get();
    }

    public function getSeverityCodes(): array
    {
        $this->url[] = 'Meta';
        $this->url[] = 'Severity';

        return $this->get();
    }

    public function getLinesAndRoutesForMode(array $modes, bool $night = false): array
    {
        $this->validator->isValidLineMode($modes);

        $this->url[] = 'Mode';
        $this->url[] = $modes;
        $this->url[] = 'Route';

        if ($night) {
            $this->params['serviceTypes'] = 'Night';
        }

        return $this->get();
    }

    public function getRoutesForLine(string $line, string $direction, bool $night = false, bool $excludeCrowding = false): array
    {
        $this->validator->isValidLine($line);
        $this->validator->isValidDirection($direction);

        $this->url[] = $line;
        $this->url[] = 'Route';
        $this->url[] = 'Sequence';
        $this->url[] = $direction;

        if ($night) {
            $this->params['serviceTypes'] = 'Night';
        }

        if ($excludeCrowding) {
            $this->params['excludeCrowding'] = 'true';
        }

        return $this->get();
    }

    public function getLinesById(array $lines): array
    {
        $this->validator->isValidLine($lines);

        $this->url[] = $lines;

        return $this->get();
    }

    public function getLinesByMode(array $modes): array
    {
        $this->validator->isValidLineMode($modes);

        $this->url[] = 'Mode';
        $this->url[] = $modes;

        return $this->get();
    }

    public function getLineStatusBySeverity(int $severity): array
    {
        $this->validator->isValidLineSeverity($severity);

        $this->url[] = 'Status';
        $this->url[] = $severity;

        return $this->get();
    }

    public function getLineStatusByPeriod(array $lines, string $from, string $to, bool $detail = true): array
    {
        $this->validator->isValidLine($lines);
        $this->validator->isValidRFC3339Date([$from, $to]);

        $this->url[] = $lines;
        $this->url[] = 'Status';
        $this->url[] = $from;
        $this->url[] = 'to';
        $this->url[] = $to;

        $this->params['detail'] = $detail ? 'true' : 'false';

        return $this->get();
    }

    public function getLineStatusForModes(array $modes, bool $detail = false, ?string $severityLevel = null): array
    {
        $this->validator->isValidLineMode($modes);

        $this->url[] = 'Mode';
        $this->url[] = $modes;
        $this->url[] = 'Status';

        if ($detail) {
            $this->params['detail'] = 'true';
        }

        if ($severityLevel) {
            $this->params['severityLevel'] = $severityLevel;
        }

        return $this->get();
    }

    public function getLineStatusById(array $ids, bool $detail = false): array
    {
        $this->validator->isValidLine($ids);

        $this->url[] = $ids;
        $this->url[] = 'Status';

        if ($detail) {
            $this->params['detail'] = 'true';
        }

        return $this->get();
    }

    public function getTimetableForLineAndStation(string $line, string $fromStopPointId, ?string $toStopPointId=null): array
    {
        $this->validator->isValidLine($line);

        $this->url[] = $line;
        $this->url[] = 'Timetable';
        $this->url[] = $fromStopPointId;

        if ($toStopPointId) {
            $this->url[] = 'to';
            $this->url[] = $toStopPointId;
        }

        return $this->get();
    }

    public function search(string $query, ?array $modes = null, ?string $types = null): array
    {
        throw MethodNotImplemented::fromName('LineService::search');
    }
}
