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
            self::ACCESSIBILITY        => ['AccessViaLift', 'AddtionalInformation', 'BlueBadgeCarParkSpaces', 'LimitedCapacityLift', 'SpecificEntranceInstructions', 'SpecificEntranceRequired', 'TaxiRankOutsideStation', 'Toilet', 'ToiletNote'],
            self::ADDRESS              => ['Address', 'PhoneNo'],
            self::DIRECTION            => ['CompassPoint', 'Towards'],
            self::FACILITY             => ['ASDA Click and Collect', 'Amazon Lockers', 'Boarding Ramp', 'Boarding Ramps', 'Bridge', 'Car park', 'Cash Machines', 'Escalators', 'Euro Cash Machines', 'Gates', 'Help Points', 'Left Luggage', 'Lifts', 'Other Facilities', 'Payphones', 'Photo Booths', 'Ticket Halls', 'Toilets', 'Waiting Room', 'WiFi'],
            self::GEO                  => ['Zone'],
            self::NEAREST_PLACES       => ['SourceSystemPlaceId'],
            self::OPENING_TIME         => ['MonFriFrom', 'MonFriTo', 'SatFrom', 'SatTo', 'SunFrom', 'SunTo'],
            self::SERVICE_INFO         => ['Night'],
            self::STATION_OWNED_BY_TFL => ['OwnedByTfl'],
            self::VISITOR_CENTRE       => ['Location'],
        };
    }
}
