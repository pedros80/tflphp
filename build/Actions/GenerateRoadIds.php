<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Build\Actions;

use Pedros80\TfLphp\Build\Actions\Abstractions\FromService;

final class GenerateRoadIds extends FromService
{
    public const ENUM_NAME = 'RoadIds';

    public function execute(): void
    {
        $service = $this->getRoadService();

        $this->writeEnum(
            $this->generateEnum(
                self::ENUM_NAME,
                array_map(fn (array $mode) => $mode['id'], $service->getRoadsManagedByTfL()),
            ),
        );
    }
}
