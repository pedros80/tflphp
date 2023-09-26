<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Services;

use Pedros80\TfLphp\Contracts\CrowdingService;
use Pedros80\TfLphp\Services\Service;

final class TfLCrowdingService extends Service implements CrowdingService
{
    public function getByDayOfWeek(string $naptan, string $dayOfWeek): array
    {
        $this->validator->isValidDayOfTheWeek($dayOfWeek);

        $this->url[] = $naptan;
        $this->url[] = $dayOfWeek;

        return $this->get();
    }

    public function getLiveByNaptan(string $naptan): array
    {
        $this->url[] = $naptan;
        $this->url[] = 'Live';

        return $this->get();
    }

    public function getByNaptan(string $naptan): array
    {
        $this->url[] = $naptan;

        return $this->get();
    }
}
