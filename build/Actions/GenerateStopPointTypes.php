<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Build\Actions;

use Pedros80\TfLphp\Build\Actions\Abstractions\FromService;

final class GenerateStopPointTypes extends FromService
{
    public const ENUM_NAME = 'StopPointTypes';

    public function execute(): void
    {
        $service = $this->getStopPointService();

        $this->writeEnum(
            $this->generateEnum(
                self::ENUM_NAME,
                $service->getTypes(),
            ),
        );
    }
}
