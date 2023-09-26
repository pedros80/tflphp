<?php

/**
 * This enum was autogenerated
 * Do NOT edit
 */

declare(strict_types=1);

namespace Pedros80\TfLphp\Enums;

enum StopPointInformationCategories: string
{
    case ACCESSIBILITY        = 'Accessibility';
    case ADDRESS              = 'Address';
    case DIRECTION            = 'Direction';
    case FACILITY             = 'Facility';
    case GEO                  = 'Geo';
    case NEAREST_PLACES       = 'NearestPlaces';
    case OPENING_TIME         = 'Opening Time';
    case SERVICE_INFO         = 'ServiceInfo';
    case STATION_OWNED_BY_TFL = 'StationOwnedByTfl';
    case VISITOR_CENTRE       = 'VisitorCentre';

    public function availableKeys(): array
    {
        return match ($this) {
            self::ACCESSIBILITY        => ['AddtionalInformation', 'LimitedCapacityLift', 'SpecificEntranceRequired', 'TaxiRankOutsideStation', 'AccessViaLift', 'BlueBadgeCarParkSpaces', 'SpecificEntranceInstructions', 'Toilet', 'ToiletNote'],
            self::ADDRESS              => ['Address', 'PhoneNo'],
            self::DIRECTION            => ['Towards', 'CompassPoint'],
            self::FACILITY             => ['Boarding Ramp', 'Lifts', 'Cash Machines', 'Waiting Room', 'Help Points', 'WiFi', 'Boarding Ramps', 'Escalators', 'ASDA Click and Collect', 'Ticket Halls', 'Euro Cash Machines', 'Payphones', 'Bridge', 'Car park', 'Gates', 'Toilets', 'Amazon Lockers', 'Other Facilities', 'Left Luggage', 'Photo Booths'],
            self::GEO                  => ['Zone'],
            self::NEAREST_PLACES       => ['SourceSystemPlaceId'],
            self::OPENING_TIME         => ['SunFrom', 'MonFriFrom', 'SatFrom', 'SunTo', 'MonFriTo', 'SatTo'],
            self::SERVICE_INFO         => ['Night'],
            self::STATION_OWNED_BY_TFL => ['OwnedByTfl'],
            self::VISITOR_CENTRE       => ['Location'],
        };
    }
}
