<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Services;

use Pedros80\TfLphp\Contracts\CrowdingService;
use Pedros80\TfLphp\Services\Service;

final class TfLCrowdingService extends Service implements CrowdingService
{
    public function dayOfWeek(string $naptan, string $dayOfWeek): array
    {
        $this->validator->isValidNaptan($naptan);
        $this->validator->isValidDayOfTheWeek($dayOfWeek);

        $this->url[] = $naptan;
        $this->url[] = $dayOfWeek;

        return $this->get();
    }

    public function live(string $naptan): array
    {
        $this->validator->isValidNaptan($naptan);

        $this->url[] = $naptan;
        $this->url[] = 'Live';

        return $this->get();
    }

    public function naptan(string $naptan): array
    {
        $this->validator->isValidNaptan($naptan);

        $this->url[] = $naptan;

        return $this->get();
    }
}
