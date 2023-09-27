<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Services;

use Pedros80\TfLphp\Enums\Directions;
use Pedros80\TfLphp\Enums\LineModes;
use Pedros80\TfLphp\Enums\PlaceTypes;
use Pedros80\TfLphp\Enums\RoadDisruptionCategories;
use Pedros80\TfLphp\Enums\RoadDisruptionSeverities;
use Pedros80\TfLphp\Enums\RoadIds;
use Pedros80\TfLphp\Enums\ServiceTypes;
use Pedros80\TfLphp\Enums\StopPointModes;
use Pedros80\TfLphp\Enums\StopPointTypes;
use Pedros80\TfLphp\Exceptions\InvalidBikePointId;
use Pedros80\TfLphp\Exceptions\InvalidCarParkId;
use Pedros80\TfLphp\Exceptions\InvalidCount;
use Pedros80\TfLphp\Exceptions\InvalidDateTime;
use Pedros80\TfLphp\Exceptions\InvalidDayOfWeek;
use Pedros80\TfLphp\Exceptions\InvalidDirection;
use Pedros80\TfLphp\Exceptions\InvalidLatitude;
use Pedros80\TfLphp\Exceptions\InvalidLineMode;
use Pedros80\TfLphp\Exceptions\InvalidLineSeverityCode;
use Pedros80\TfLphp\Exceptions\InvalidLongitude;
use Pedros80\TfLphp\Exceptions\InvalidPage;
use Pedros80\TfLphp\Exceptions\InvalidPlaceType;
use Pedros80\TfLphp\Exceptions\InvalidRoadDisruption;
use Pedros80\TfLphp\Exceptions\InvalidRoadDisruptionCategory;
use Pedros80\TfLphp\Exceptions\InvalidRoadDisruptionSeverity;
use Pedros80\TfLphp\Exceptions\InvalidRoadId;
use Pedros80\TfLphp\Exceptions\InvalidServiceType;
use Pedros80\TfLphp\Exceptions\InvalidSmsCode;
use Pedros80\TfLphp\Exceptions\InvalidStopPointMode;
use Pedros80\TfLphp\Exceptions\InvalidStopPointType;
use Pedros80\TfLphp\Exceptions\MissingRequiredPlaceTypes;
use Pedros80\TfLphp\Params\Line;
use Safe\DateTime;
use Safe\Exceptions\DatetimeException;
use ValueError;

use function Safe\preg_match;

final class Validator
{
    public function isValidLatLng(string $lat, string $lng): void
    {
        $lat = floatval($lat);
        $lng = floatval($lng);

        if ($lat < -90 || $lat > 90) {
            throw InvalidLatitude::fromString((string) $lat);
        }

        if ($lng < -180 || $lng > 180) {
            throw InvalidLongitude::fromString((string) $lng);
        }
    }

    public function isValidLine(string|array $lines): void
    {
        $lines = $this->ensureArray($lines);

        foreach ($lines as $line) {
            new Line($line);
        }
    }

    public function isValidPlaceType(string|array $placeTypes): void
    {
        $placeTypes = $this->ensureArray($placeTypes);

        foreach ($placeTypes as $placeType) {
            try {
                PlaceTypes::from($placeType);
            } catch (ValueError) {
                throw InvalidPlaceType::fromString($placeType);
            }
        }
    }

    public function isValidBikePointId(string|array $bikePointIds): void
    {
        $bikePointIds = $this->ensureArray($bikePointIds);

        foreach ($bikePointIds as $bikePointId) {
            if (!preg_match('/^BikePoints_\d+$/', $bikePointId)) {
                throw InvalidBikePointId::fromString($bikePointId);
            }
        }
    }

    public function isValidCarParkId(string|array $carParkIds): void
    {
        $carParkIds = $this->ensureArray($carParkIds);

        foreach ($carParkIds as $carParkId) {
            if (!preg_match('/^CarParks_\d+$/', $carParkId)) {
                throw InvalidCarParkId::fromString($carParkId);
            }
        }
    }

    public function isValidDayOfTheWeek(string|array $days): void
    {
        $days = $this->ensureArray($days);

        foreach ($days as $day) {
            if (!in_array($day, ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'])) {
                throw InvalidDayOfWeek::fromString($day);
            }
        }
    }

    public function isValidServiceType(string|array $serviceTypes): void
    {
        $serviceTypes = $this->ensureArray($serviceTypes);

        foreach ($serviceTypes as $serviceType) {
            try {
                ServiceTypes::from($serviceType);
            } catch (ValueError) {
                throw InvalidServiceType::fromString($serviceType);
            }
        }
    }

    public function isValidLineSeverity(int $severity): void
    {
        if ($severity < 0 || $severity > 20) {
            throw InvalidLineSeverityCode::fromInt($severity);
        }
    }

    public function isValidRoadDisruptionSeverity(int|array $severities): void
    {
        $severities = $this->ensureArray($severities);

        foreach ($severities as $severity) {
            try {
                RoadDisruptionSeverities::from($severity);
            } catch (ValueError) {
                throw InvalidRoadDisruptionSeverity::fromInt($severity);
            }
        }
    }

    public function isValidRoadDisruptionCategories(string|array $categories): void
    {
        $categories = $this->ensureArray($categories);

        foreach ($categories as $category) {
            try {
                RoadDisruptionCategories::from($category);
            } catch (ValueError) {
                throw InvalidRoadDisruptionCategory::fromString($category);
            }
        }
    }

    public function isValidDirection(string|array $directions): void
    {
        $directions = $this->ensureArray($directions);

        foreach ($directions as $direction) {
            try {
                Directions::from($direction);
            } catch (ValueError) {
                throw InvalidDirection::fromString($direction);
            }
        }
    }

    public function isValidLineMode(string|array $modes): void
    {
        $modes = $this->ensureArray($modes);

        foreach ($modes as $mode) {
            try {
                LineModes::from($mode);
            } catch (ValueError) {
                throw InvalidLineMode::fromString($mode);
            }
        }
    }

    public function isValidStopPointMode(string|array $modes): void
    {
        $modes = $this->ensureArray($modes);

        foreach ($modes as $mode) {
            try {
                StopPointModes::from($mode);
            } catch (ValueError) {
                throw InvalidStopPointMode::fromString($mode);
            }
        }
    }

    public function hasStopPointTypes(array $types): void
    {
        if (!count($types)) {
            throw MissingRequiredPlaceTypes::new();
        }
    }

    public function isValidPage(int $page): void
    {
        if ($page < 1) {
            throw InvalidPage::fromInt($page);
        }
    }

    public function isValidStopPointType(string|array $types): void
    {
        $types = $this->ensureArray($types);

        foreach ($types as $type) {
            try {
                StopPointTypes::from($type);
            } catch (ValueError) {
                throw InvalidStopPointType::fromString($type);
            }
        }
    }

    public function isValidRoadDisruption(string|array $codes): void
    {
        $codes = $this->ensureArray($codes);

        foreach ($codes as $code) {
            try {
                RoadDisruptionCategories::from($code);
            } catch (ValueError) {
                throw InvalidRoadDisruption::fromString($code);
            }
        }
    }

    public function isValidRoadId(string|array $roads): void
    {
        $roads = $this->ensureArray($roads);

        foreach ($roads as $road) {
            try {
                RoadIds::from($road);
            } catch (ValueError) {
                throw InvalidRoadId::fromString($road);
            }
        }
    }

    public function isValidSmsCode(string|array $codes): void
    {
        $codes = $this->ensureArray($codes);

        foreach ($codes as $code) {
            if (!preg_match('/^\d{5}$/', $code)) {
                throw InvalidSmsCode::fromString($code);
            }
        }
    }

    public function isValidRFC3339Date(string|array $dates): void
    {
        $dates = $this->ensureArray($dates);

        foreach ($dates as $date) {
            try {
                DateTime::createFromFormat(DateTime::RFC3339, $date);
            } catch (DatetimeException) {
                throw InvalidDateTime::fromString($date);
            }
        }
    }

    public function isValidCount(int $count): void
    {
        if ($count < -1) {
            throw InvalidCount::fromInt($count);
        }
    }

    private function ensureArray(string|array|int $value): array
    {
        $value = is_array($value) ? $value : [$value];

        return array_filter($value);
    }
}
