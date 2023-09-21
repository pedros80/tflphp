<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Contracts;

interface PlaceService
{
    /**
     * Gets a list of all of the available place property categories and keys
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=Place&operation=Place_MetaCategories
     */
    public function getPlaceCategories(): array;

    /**
     * Gets a list of the available types of Place
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=Place&operation=Place_MetaPlaceTypes
     */
    public function getPlaceTypes(): array;

    /**
     * Gets all places of a given type
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=Place&operation=Place_GetByTypeByPathTypesQueryActiveOnly
     */
    public function getPlacesByType(array $types, bool $activeOnly=false): array;

    /**
     * Gets all places that matches the given query
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=Place&operation=Place_SearchByQueryNameQueryTypes
     */
    public function searchByName(string $name, array $types=[]): array;

    /**
     * Gets any places of the given type whose geography intersects the given latitude and longitude.
     * In practice this means the Place must be polygonal e.g. a BoroughBoundary.
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=Place&operation=Place_GetAtByPathTypePathLatPathLon
     */
    public function getPlacesByTypeAndLatLng(array $types, string $lat, string $lng): array;

    /**
     * Gets the place with the given id.
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=Place&operation=Place_GetByPathIdQueryIncludeChildren
     */
    public function getPlaceById(string $id, bool $includeChildren = false): array;

    /**
     * Gets the places that lie within a geographic region.
     * The geographic region of interest can either be specified by using a lat/lon geo-point and a radius in metres
     * to return places within the locus defined by the lat/lon of its centre or alternatively,
     * by the use of a bounding box defined by the lat/lon of its north-west and south-east corners.
     * Optionally filters on type and can strip properties for a smaller payload.
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=Place&operation=Place_GetByGeoPointByQueryLatQueryLonQueryRadiusQueryCategoriesQueryIncludeC
     */
    public function getPlacesByGeo(
        string $lat,
        string $lng,
        ?string $radius=null,
        array $categories=[],
        bool $includeChildren=false,
        array $types=[],
        bool $activeOnly=false,
        ?int $numberOfPlacesToReturn=null
    ): array;
}
