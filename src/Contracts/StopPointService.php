<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Contracts;

interface StopPointService
{
    /**
     * Get a list of places corresponding to a given id and place types.
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=StopPoint&operation=StopPoint_GetByPathIdQueryPlaceTypes
     */
    public function getPlacesByIdAndTypes(string $id, array $types=[]): array;

    /**
     * Get car parks corresponding to the given stop point id.
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=StopPoint&operation=StopPoint_GetCarParksByIdByPathStopPointId
     */
    public function getCarParksById(string $id): array;

    /**
     * Gets a distinct list of disrupted stop points for the given modes
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=StopPoint&operation=StopPoint_DisruptionByModeByPathModesQueryIncludeRouteBlockedStops
     */
    public function getDisruptedStopPointsByMode(array $modes, bool $includeRouteBlockedStops=false): array;

    /**
     * Gets a list of StopPoints corresponding to the given list of stop ids.
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=StopPoint&operation=StopPoint_GetByPathIdsQueryIncludeCrowdingData
     */
    public function getStopPointsById(array $ids, bool $includeCrowdingData=false): array;

    /**
     * Gets a list of StopPoints filtered by the modes available at that StopPoint.
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=StopPoint&operation=StopPoint_GetByModeByPathModesQueryPage
     */
    public function getStopPointsByMode(array $modes, int $page=1): array;

    /**
     * Gets a list of StopPoints within {radius} by the specified criteria
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=StopPoint&operation=StopPoint_GetByGeoPointByQueryLatQueryLonQueryStopTypesQueryRadiusQueryUseSt
     */
    public function searchPointsByRadius(float $lat, float $lng, array $stopTypes, ?int $radius=null, bool $useStopPointHierarchy=false, array $modes=[], array $categories=[], bool $returnLines=false): array;

    /**
     * Gets a list of taxi ranks corresponding to the given stop point id.
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=StopPoint&operation=StopPoint_GetTaxiRanksByIdsByPathStopPointId
     */
    public function getTaxiRanksById(string $id): array;

    /**
     * Gets a StopPoint for a given sms code.
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=StopPoint&operation=StopPoint_GetBySmsByPathIdQueryOutput
     */
    public function getStopPointBySMSCode(string $id): array;

    /**
     * Gets all disruptions for the specified StopPointId, plus disruptions for any child Naptan records it may have.
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=StopPoint&operation=StopPoint_DisruptionByPathIdsQueryGetFamilyQueryIncludeRouteBlockedStopsQuer
     */
    public function getDisruptedStopPointsById(array $ids, bool $getFamily=false, bool $includeRouteBlockedStops=false, bool $flattenResponse=false): array;

    /**
     * Gets all stop points of a given type
     * Gets all the stop points of given type(s) with a page number
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=StopPoint&operation=StopPoint_GetByTypeByPathTypes
     */
    public function getStopPointsByType(array $types, int $page=0): array;

    /**
     * Gets all the Crowding data (static) for the StopPointId, plus crowding data for a given line and optionally a particular direction.
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=StopPoint&operation=StopPoint_CrowdingByPathIdPathLineQueryDirection
     */
    public function getCrowdingDataByIdAndLine(string $id, string $line, string $direction='all'): array;

    /**
     * Gets Stopoints that are reachable from a station/line combination.
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=StopPoint&operation=StopPoint_ReachableFromByPathIdPathLineIdQueryServiceTypes
     */
    public function getReachablePointsFromStopAndLine(string $id, string $line, ?string $serviceTypes=null): array;

    /**
     * Gets the list of arrival and departure predictions for the given stop point id (overground and tfl rail only)
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=StopPoint&operation=StopPoint_ArrivalDeparturesByPathIdQueryLineIds
     */
    public function getArrivalAndDepartureById(string $id, array $lines): array;

    /**
     * Gets the list of arrival predictions for the given stop point id
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=StopPoint&operation=StopPoint_ArrivalsByPathId
     */
    public function getArrivalsById(string $id): array;

    /**
     * Gets the list of available StopPoint additional information categories
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=StopPoint&operation=StopPoint_MetaCategories
     */
    public function getInformationCategories(): array;

    /**
     * Gets the list of available StopPoint modes
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=StopPoint&operation=StopPoint_MetaModes
     */
    public function getModes(): array;

    /**
     * Gets the list of available StopPoint types
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=StopPoint&operation=StopPoint_MetaStopTypes
     */
    public function getTypes(): array;

    /**
     * Gets the service types for a given stoppoint
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=StopPoint&operation=StopPoint_GetServiceTypesByQueryIdQueryLineIdsQueryModes
     */
    public function getServiceTypesFromId(string $id, array $lines=[], array $modes=[]): array;

    /**
     * Returns the canonical direction, "inbound" or "outbound", for a given pair of stop point Ids in the direction from -> to.
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=StopPoint&operation=StopPoint_DirectionByPathIdPathToStopPointIdQueryLineId
     */
    public function getDirectionBetweenIds(string $id, string $toStopPointId, string $lineId=null): array;

    /**
     * Returns the route sections for all the lines that service the given stop point ids
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=StopPoint&operation=StopPoint_RouteByPathIdQueryServiceTypes
     */
    public function getRouteSectionsById(string $id, array $serviceTypes=[]): array;

    /**
     * Search StopPoints by their common name, or their 5-digit Countdown Bus Stop Code.
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=StopPoint&operation=StopPoint_SearchByQueryQueryQueryModesQueryFaresOnlyQueryMaxResultsQueryLine
     */
    public function search(string $query, array $modes=[], bool $faresOnly=false, int $maxResults=0, array $lines=[], bool $includeHubs=false, bool $tflOperatedNationalRailStationsOnly=false): array;
}
