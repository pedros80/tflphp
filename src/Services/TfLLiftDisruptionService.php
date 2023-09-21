<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Services;

use Pedros80\TfLphp\Contracts\LiftDisruptionService;
use Pedros80\TfLphp\Services\Service;

final class TfLLiftDisruptionService extends Service implements LiftDisruptionService
{
    public function getDisruptions(bool $v2 = true): array
    {
        if ($v2) {
            $this->url[] = 'v2';
        }

        return $this->get();
    }
}
