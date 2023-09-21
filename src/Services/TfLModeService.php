<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Services;

use Pedros80\TfLphp\Contracts\ModeService;
use Pedros80\TfLphp\Services\Service;

final class TfLModeService extends Service implements ModeService
{
    public function getArrivalPredictions(string $mode, ?int $count=null): array
    {
        $this->validator->isValidLineMode($mode);

        $this->url[] = $mode;
        $this->url[] = 'Arrivals';

        if (!is_null($count)) {
            $this->validator->isValidCount($count);
            $this->params['count'] = $count;
        }

        return $this->get(
            auth: false
        );
    }

    public function getActiveServiceType(): array
    {
        $this->url[] = 'ActiveServiceTypes';

        return $this->get();
    }
}
