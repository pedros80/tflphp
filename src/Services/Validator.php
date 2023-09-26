<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Services;

use Pedros80\TfLphp\Enums\Directions;
use Pedros80\TfLphp\Enums\LineModes;
use Pedros80\TfLphp\Enums\PlaceTypes;
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
use Pedros80\TfLphp\Exceptions\InvalidServiceType;
use Pedros80\TfLphp\Exceptions\InvalidSmsCode;
use Pedros80\TfLphp\Exceptions\InvalidStopPointMode;
use Pedros80\TfLphp\Exceptions\InvalidStopPointType;
use Pedros80\TfLphp\Exceptions\MissingRequiredPlaceTypes;
use Pedros80\TfLphp\Params\Line;
use Pedros80\TfLphp\Params\Station;
use Safe\DateTime;
use Safe\Exceptions\DatetimeException;
use ValueError;

use function Safe\preg_match;

final class Validator
{
    public function isValidLatLng(string $lat, string $lng): bool
    {
        $lat = floatval($lat);
        $lng = floatval($lng);

        if ($lat < -90 || $lat > 90) {
            throw InvalidLatitude::fromString((string) $lat);
        }

        if ($lng < -180 || $lng > 180) {
            throw InvalidLongitude::fromString((string) $lng);
        }

        return true;
    }

    public function isValidLine(string|array $lines): bool
    {
        $lines = $this->ensureArray($lines);

        foreach ($lines as $line) {
            new Line($line);
        }

        return true;
    }

    public function isValidPlaceType(string|array $placeTypes): bool
    {
        $placeTypes = $this->ensureArray($placeTypes);

        foreach ($placeTypes as $placeType) {
            try {
                PlaceTypes::from($placeType);
            } catch (ValueError) {
                throw InvalidPlaceType::fromString($placeType);
            }
        }

        return true;
    }

    public function isValidBikePointId(string|array $bikePointIds): bool
    {
        $bikePointIds = $this->ensureArray($bikePointIds);

        foreach ($bikePointIds as $bikePointId) {
            if (!preg_match('/^BikePoints_\d+$/', $bikePointId)) {
                throw InvalidBikePointId::fromString($bikePointId);
            }
        }

        return true;
    }

    public function isValidCarParkId(string|array $carParkIds): bool
    {
        $carParkIds = $this->ensureArray($carParkIds);

        foreach ($carParkIds as $carParkId) {
            if (!preg_match('/^CarParks_\d+$/', $carParkId)) {
                throw InvalidCarParkId::fromString($carParkId);
            }
        }

        return true;
    }

    public function isValidDayOfTheWeek(string|array $days): bool
    {
        $days = $this->ensureArray($days);

        foreach ($days as $day) {
            if (!in_array($day, ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'])) {
                throw InvalidDayOfWeek::fromString($day);
            }
        }

        return true;
    }

    public function isValidServiceType(string|array $serviceTypes): bool
    {
        $serviceTypes = $this->ensureArray($serviceTypes);

        foreach ($serviceTypes as $serviceType) {
            try {
                ServiceTypes::from($serviceType);
            } catch (ValueError) {
                throw InvalidServiceType::fromString($serviceType);
            }
        }

        return true;
    }

    public function isValidLineSeverity(int $severity): bool
    {
        if ($severity < 0 || $severity > 20) {
            throw InvalidLineSeverityCode::fromInt($severity);
        }

        return true;
    }

    public function isValidDirection(string|array $directions): bool
    {
        $directions = $this->ensureArray($directions);

        foreach ($directions as $direction) {
            try {
                Directions::from($direction);
            } catch (ValueError) {
                throw InvalidDirection::fromString($direction);
            }
        }

        return true;
    }

    public function isValidLineMode(string|array $modes): bool
    {
        $modes = $this->ensureArray($modes);

        foreach ($modes as $mode) {
            try {
                LineModes::from($mode);
            } catch (ValueError) {
                throw InvalidLineMode::fromString($mode);
            }
        }

        return true;
    }

    public function isValidStopPointMode(string|array $modes): bool
    {
        $modes = $this->ensureArray($modes);

        foreach ($modes as $mode) {
            try {
                StopPointModes::from($mode);
            } catch (ValueError) {
                throw InvalidStopPointMode::fromString($mode);
            }
        }

        return true;
    }

    public function hasStopPointTypes(array $types): bool
    {
        if (!count($types)) {
            throw MissingRequiredPlaceTypes::new();
        }

        return true;
    }

    public function isValidPage(int $page): bool
    {
        if ($page < 1) {
            throw InvalidPage::fromInt($page);
        }

        return true;
    }

    public function isValidStopPointType(string|array $types): bool
    {
        $types = $this->ensureArray($types);

        foreach ($types as $type) {
            try {
                StopPointTypes::from($type);
            } catch (ValueError) {
                throw InvalidStopPointType::fromString($type);
            }
        }

        return true;
    }

    public function isValidSmsCode(string|array $codes): bool
    {
        $codes = $this->ensureArray($codes);

        foreach ($codes as $code) {
            if (!preg_match('/^\d{5}$/', $code)) {
                throw InvalidSmsCode::fromString($code);
            }
        }

        return true;
    }

    public function isValidRFC3339Date(string|array $dates): bool
    {
        $dates = $this->ensureArray($dates);

        foreach ($dates as $date) {
            try {
                DateTime::createFromFormat(DateTime::RFC3339, $date);
            } catch (DatetimeException) {
                throw InvalidDateTime::fromString($date);
            }
        }

        return true;
    }

    public function isValidCount(int $count): bool
    {
        if ($count < -1) {
            throw InvalidCount::fromInt($count);
        }

        return true;
    }

    private function ensureArray(string|array $value): array
    {
        return is_array($value) ? $value : [$value];
    }
}
