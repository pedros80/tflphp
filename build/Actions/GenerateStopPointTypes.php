<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Build\Actions;

use Pedros80\TfLphp\Build\Actions\Abstractions\FromService;
use Pedros80\TfLphp\Contracts\StopPointService;
use Pedros80\TfLphp\Factories\ServiceFactory;

final class GenerateStopPointTypes extends FromService
{
    public const ENUM_NAME = 'StopPointTypes';

    public function execute(): void
    {
        /** @var StopPointService $service */
        $service = $this->getService(ServiceFactory::STOP_POINT);

        $this->writeEnum(
            $this->generateEnum(
                self::ENUM_NAME,
                $service->getTypes()
            )
        );
    }
}
