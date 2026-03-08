<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Build\Actions;

use Pedros80\TfLphp\Build\Actions\Abstractions\FromService;

final class GeneratePlaceTypes extends FromService
{
    public const ENUM_NAME = 'PlaceTypes';

    public function execute(): void
    {
        $service = $this->getPlaceService();

        $this->writeEnum(
            $this->generateEnum(
                self::ENUM_NAME,
                $service->getPlaceTypes(),
            ),
        );
    }
}
