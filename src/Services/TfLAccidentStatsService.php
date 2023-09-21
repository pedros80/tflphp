<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Services;

use Pedros80\TfLphp\Contracts\AccidentStatsService;
use Pedros80\TfLphp\Exceptions\MethodNotImplemented;
use Pedros80\TfLphp\Services\Service;

final class TfLAccidentStatsService extends Service implements AccidentStatsService
{
    public function getDetails(int $year): array
    {
        // something odd going on
        // throw MethodNotImplemented::fromName('AccidentStatsService::getDetails()');

        $this->url[] = $year;

        return $this->get();
    }
}
