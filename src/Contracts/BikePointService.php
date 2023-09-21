<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Contracts;

interface BikePointService
{
    /**
     * Gets all bike point locations
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=BikePoint&operation=BikePoint_GetAll
     */
    public function getAll(): array;

    /**
     * Gets the bike point with the given id
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=BikePoint&operation=BikePoint_Get
     */
    public function getById(string $id): array;

    /**
     * Search for bike stations by their name
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=BikePoint&operation=BikePoint_Search
     */
    public function search(string $search): array;
}
