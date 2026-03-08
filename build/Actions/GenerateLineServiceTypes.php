<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Build\Actions;

use Pedros80\TfLphp\Build\Actions\Abstractions\FromService;

final class GenerateLineServiceTypes extends FromService
{
    public const ENUM_NAME = 'LineServiceTypes';

    public function execute(): void
    {
        $service = $this->getLineService();

        $this->writeEnum(
            $this->generateEnum(
                self::ENUM_NAME,
                $service->getServiceTypes(),
            ),
        );
    }
}
