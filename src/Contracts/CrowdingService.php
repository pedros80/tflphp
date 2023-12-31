<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Contracts;

interface CrowdingService
{
    /**
     * Returns crowding information for Naptan for Day of Week
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=crowding&operation=dayofweek
     */
    public function getByDayOfWeek(string $naptan, string $dayOfWeek): array;

    /**
     * Returns live crowding information for Naptan
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=crowding&operation=live
     */
    public function getLiveByNaptan(string $naptan): array;

    /**
     * Returns crowding information for Naptan
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=crowding&operation=naptan
     */
    public function getByNaptan(string $naptan): array;
}
