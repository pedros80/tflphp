<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Contracts;

interface RoadService
{
    /**
     * Get active disruptions, filtered by road ids
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=Road&operation=Road_DisruptionByPathIdsQueryStripContentQuerySeveritiesQueryCategoriesQuery
     */
    public function getDisruptionsByRoadId(array $ids, bool $stripContent=false, ?array $severities=null, ?array $categories=null, bool $closures=false): array;

    /**
     * Gets a list of active disruptions filtered by disruption Ids.
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=Road&operation=Road_DisruptionByIdByPathDisruptionIdsQueryStripContent
     */
    public function getDisruptionsById(array $ids, bool $stripContent=false): array;

    /**
     * Gets a list of disrupted streets. If no date filters are provided, current disruptions are returned.
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=Road&operation=Road_DisruptedStreetsByQueryStartDateQueryEndDate
     */
    public function getDisruptedStreets(?string $startDate=null, ?string $endDate=null): array;

    /**
     * Gets a list of valid RoadDisruption categories
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=Road&operation=Road_MetaCategories
     */
    public function getDisruptionCategories(): array;

    /**
     * Gets a list of valid RoadDisruption severity codes
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=Road&operation=Road_MetaSeverities
     */
    public function getDisruptionSeverities(): array;

    /**
     * Gets all roads managed by TfL
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=Road&operation=Road_Get
     */
    public function getRoadsManagedByTfL(): array;

    /**
     * Gets the road with the specified id (e.g. A1)
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=Road&operation=Road_GetByPathIds
     */
    public function getRoadById(array $ids): array;

    /**
     * Gets the specified roads with the status aggregated over the date range specified, or now until the end of today if no dates are passed.
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=Road&operation=Road_StatusByPathIdsQueryStartDateQueryEndDate
     */
    public function getRoadStatus(array $ids, ?string $startDate=null, ?string $endDate=null): array;
}
