<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Build\Actions;

use Pedros80\TfLphp\Build\Actions\Abstractions\FromService;

final class GeneratePlaceCategories extends FromService
{
    public const ENUM_NAME = 'PlaceCategories';

    public function execute(): void
    {
        $service = $this->getPlaceService();

        $this->writeEnum(
            $this->generateEnum(
                self::ENUM_NAME,
                array_map(fn (array $mode) => $mode['category'], $service->getPlaceCategories()),
            ),
        );
    }
}
