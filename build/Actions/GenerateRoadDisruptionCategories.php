<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Build\Actions;

use Pedros80\TfLphp\Build\Actions\Abstractions\FromService;

final class GenerateRoadDisruptionCategories extends FromService
{
    public const ENUM_NAME = 'RoadDisruptionCategories';

    public function execute(): void
    {
        $service = $this->getRoadService();

        $this->writeEnum(
            $this->generateEnum(
                self::ENUM_NAME,
                $service->getDisruptionCategories(),
            ),
        );
    }
}
