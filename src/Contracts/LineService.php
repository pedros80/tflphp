<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Contracts;

interface LineService
{
    /**
     * Get all valid routes for all lines, including the name and id of the originating and terminating stops for each route.
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=Line&operation=Line_LineRoutesByIdsByPathIdsQueryServiceTypes
     * @link https://api-portal.tfl.gov.uk/api-details#api=Line&operation=Line_RouteByQueryServiceTypes
     */
    public function getRoutes(array $lines = [], bool $night = false): array;

    /**
     * Get disruptions for all lines of the given modes
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=Line&operation=Line_DisruptionByModeByPathModes
     */
    public function getDisruptionsForAllLines(array $modes): array;

    /**
     * Get disruptions for the given line ids
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=Line&operation=Line_DisruptionByPathIds
     */
    public function getDisruptionsForLines(array $lines): array;

    /**
     * Get the list of arrival predictions for given line ids
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=Line&operation=Line_ArrivalsByPathIds
     */
    public function getArrivalsByLine(array $lines): array;

    /**
     * Get the list of arrival predictions for given line ids based at the given stop
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=Line&operation=Line_ArrivalsWithStopPointByPathIdsPathStopPointIdQueryDirectionQueryDestina
     */
    public function getArrivalsByLineAndStop(array $lines, string $stopPointId, ?string $direction=null, ?string $destinationStationId=null): array;

    /**
     * Gets a list of the stations that serve the given line id
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=Line&operation=Line_StopPointsByPathIdQueryTflOperatedNationalRailStationsOnly
     */
    public function getServingStations(string $line, bool $tflOperatedNationalRailStationsOnly=false): array;

    /**
     * Gets a list of valid disruption categories
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=Line&operation=Line_MetaDisruptionCategories
     */
    public function getDisruptionCategories(): array;

    /**
     * Gets a list of valid modes
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=Line&operation=Line_MetaModes
     */
    public function getModes(): array;

    /**
     * Gets a list of valid ServiceTypes to filter on
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=Line&operation=Line_MetaServiceTypes
     */
    public function getServiceTypes(): array;

    /**
     * Gets a list of valid severity codes
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=Line&operation=Line_MetaSeverity
     */
    public function getSeverityCodes(): array;

    /**
     * Gets all lines and their valid routes for given modes
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=Line&operation=Line_RouteByModeByPathModesQueryServiceTypes
     */
    public function getLinesAndRoutesForMode(array $modes, bool $night=false): array;

    /**
     * Gets all valid routes for given line id, including the sequence of stops on each route
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=Line&operation=Line_RouteSequenceByPathIdPathDirectionQueryServiceTypesQueryExcludeCrowding
     */
    public function getRoutesForLine(string $line, string $direction, bool $night=false, bool $excludeCrowding=false): array;

    /**
     * Gets lines that match the specified line ids
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=Line&operation=Line_GetByPathIds
     */
    public function getLinesById(array $lines): array;

    /**
     * Gets lines that serve the given modes
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=Line&operation=Line_GetByModeByPathModes
     */
    public function getLinesByMode(array $modes): array;

    /**
     * Gets the line status for all lines with a given severity
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=Line&operation=Line_StatusBySeverityByPathSeverity
     */
    public function getLineStatusBySeverity(int $severity): array;

    /**
     * Gets the line status for given line ids during the provided dates e.g Minor Delays
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=Line&operation=Line_StatusByPathIdsPathStartDatePathEndDateQueryDetail
     */
    public function getLineStatusByPeriod(array $lines, string $from, string $to, bool $detail=false): array;

    /**
     * Gets the line status of for all lines for the given modes
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=Line&operation=Line_StatusByModeByPathModesQueryDetailQuerySeverityLevel
     */
    public function getLineStatusForModes(array $modes, bool $detail=false, bool $severityLevel=false): array;

    /**
     * Gets the line status of for given line ids e.g Minor Delays
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=Line&operation=Line_StatusByIdsByPathIdsQueryDetail
     */
    public function getLineStatusById(array $ids, bool $detail=false): array;

    /**
     * Gets the timetable for a specified station on the give line
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=Line&operation=Line_TimetableByPathFromStopPointIdPathId
     */
    public function getTimetableForLineAndStation(string $line, string $fromStopPointId, ?string $toStopPointId=null): array;

    /**
     * Search for lines or routes matching the query string
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=Line&operation=Line_SearchByPathQueryQueryModesQueryServiceTypes
     */
    public function search(string $query, ?array $modes=null, ?string $types=null): array;
}
