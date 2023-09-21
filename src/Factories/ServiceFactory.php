<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Factories;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Pedros80\TfLphp\Exceptions\ServiceNotImplemented;
use Pedros80\TfLphp\Services\Service;
use Pedros80\TfLphp\Services\TfLAccidentStatsService;
use Pedros80\TfLphp\Services\TfLAirQualityService;
use Pedros80\TfLphp\Services\TfLBikePointService;
use Pedros80\TfLphp\Services\TfLCrowdingService;
use Pedros80\TfLphp\Services\TfLJourneyService;
use Pedros80\TfLphp\Services\TfLLiftDisruptionService;
use Pedros80\TfLphp\Services\TfLLineService;
use Pedros80\TfLphp\Services\TfLModeService;
use Pedros80\TfLphp\Services\TfLOccupancyService;
use Pedros80\TfLphp\Services\TfLPlaceService;
use Pedros80\TfLphp\Services\TfLRoadService;
use Pedros80\TfLphp\Services\TfLStopPointService;
use Pedros80\TfLphp\Services\TfLVehicleService;
use Pedros80\TfLphp\Services\Validator;

final class ServiceFactory
{
    private const BASE_URI   = 'https://api.tfl.gov.uk/';
    private const USER_AGENT = 'TfLphp';
    private const TIMEOUT    = 20;

    public const ACCIDENT_STATS  = 'AccidentStats';
    public const AIR_QUALITY     = 'AirQuality';
    public const BIKE_POINT      = 'BikePoint';
    public const CROWDING        = 'crowding';
    public const JOURNEY         = 'Journey';
    public const LIFT_DISRUPTION = 'Disruptions/Lifts';
    public const LINE            = 'Line';
    public const MODE            = 'Mode';
    public const OCCUPANCY       = 'Occupancy';
    public const PLACE           = 'Place';
    public const ROAD            = 'Road';
    public const STOP_POINT      = 'StopPoint';
    public const VEHICLE         = 'Vehicle';

    public function makeService(string $type, string $apiKey): Service
    {
        return match ($type) {
            self::ACCIDENT_STATS  => new TfLAccidentStatsService($apiKey, $this->makeClient(self::ACCIDENT_STATS), new Validator()),
            self::AIR_QUALITY     => new TfLAirQualityService($apiKey, $this->makeClient(self::AIR_QUALITY), new Validator()),
            self::BIKE_POINT      => new TfLBikePointService($apiKey, $this->makeClient(self::BIKE_POINT), new Validator()),
            self::CROWDING        => new TfLCrowdingService($apiKey, $this->makeClient(self::CROWDING), new Validator()),
            self::JOURNEY         => new TfLJourneyService($apiKey, $this->makeClient(self::JOURNEY), new Validator()),
            self::LIFT_DISRUPTION => new TfLLiftDisruptionService($apiKey, $this->makeClient(self::LIFT_DISRUPTION), new Validator()),
            self::LINE            => new TfLLineService($apiKey, $this->makeClient(self::LINE), new Validator()),
            self::MODE            => new TfLModeService($apiKey, $this->makeClient(self::MODE), new Validator()),
            self::PLACE           => new TfLPlaceService($apiKey, $this->makeClient(self::PLACE), new Validator()),
            self::ROAD            => new TfLRoadService($apiKey, $this->makeClient(self::ROAD), new Validator()),
            self::STOP_POINT      => new TfLStopPointService($apiKey, $this->makeClient(self::STOP_POINT), new Validator()),
            self::VEHICLE         => new TfLVehicleService($apiKey, $this->makeClient(self::VEHICLE), new Validator()),
            self::OCCUPANCY       => new TfLOccupancyService($apiKey, $this->makeClient(self::OCCUPANCY), new Validator()),
            default               => throw ServiceNotImplemented::fromType($type)
        };
    }

    private function makeClient(string $type): Client
    {
        return new Client([
            'base_uri'               => self::BASE_URI . $type . '/',
            RequestOptions::HEADERS  => [
                'User-Agent'    => self::USER_AGENT,
                'Content-Type'  => 'application/json',
                'Cache-Control' => 'no-cache',
            ],
            RequestOptions::TIMEOUT => self::TIMEOUT,
        ]);
    }
}
