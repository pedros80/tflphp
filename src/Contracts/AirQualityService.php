<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Contracts;

interface AirQualityService
{
    /**
     * Gets air quality data feed
     *
     * @link https://api-portal.tfl.gov.uk/api-details#api=AirQuality&operation=AirQuality_Get
     */
    public function getFeed(): array;
}
