<?php

declare(strict_types=1);

namespace Pedros80\Build\Actions;

use Pedros80\Build\Actions\Abstractions\FromService;
use Pedros80\TfLphp\Contracts\LineService;
use Pedros80\TfLphp\Factories\ServiceFactory;

final class GenerateLineServiceTypes extends FromService
{
    public const ENUM_NAME = 'LineServiceTypes';

    public function execute(): void
    {
        /** @var LineService $service */
        $service = $this->getService(ServiceFactory::LINE);

        $this->writeEnum(
            $this->generateEnum(
                self::ENUM_NAME,
                $service->getServiceTypes()
            )
        );
    }
}
