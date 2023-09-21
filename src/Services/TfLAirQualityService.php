<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Services;

use Pedros80\TfLphp\Contracts\AirQualityService;
use Pedros80\TfLphp\Services\Service;

final class TfLAirQualityService extends Service implements AirQualityService
{
    public function getFeed(): array
    {
        return $this->get();
    }
}
