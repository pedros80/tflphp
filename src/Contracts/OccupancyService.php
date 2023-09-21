<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Contracts;

interface OccupancyService
{
    /**
     * Get the occupancy for bike points
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=Occupancy&operation=Occupancy_GetBikePointsOccupanciesByPathIds
     */
    public function getOccupancyForBikePoint(string $id): array;

    /**
     * Gets the occupancy for a car park with a given id
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=Occupancy&operation=Occupancy_GetByPathId
     */
    public function getOccupancyForCarPark(string $id): array;

    /**
     * Gets the occupancy for all car parks that have occupancy data
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=Occupancy&operation=Occupancy_Get
     */
    public function getOccupancyForAllCarParks(): array;

    /**
     * Gets the occupancy for a charge connectors with a given id
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=Occupancy&operation=Occupancy_GetChargeConnectorStatusByPathIds
     */
    public function getOccupancyForChargeConnector(string $id): array;

    /**
     * Gets the occupancy for all charge connectors
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=Occupancy&operation=Occupancy_GetAllChargeConnectorStatus
     */
    public function getOccupancyForAllChargeConnectors(): array;
}
