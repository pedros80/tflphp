<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Build\Actions;

use Pedros80\TfLphp\Build\Actions\Abstractions\FromService;
use Pedros80\TfLphp\Contracts\PlaceService;
use Pedros80\TfLphp\Factories\ServiceFactory;

final class GeneratePlaceCategories extends FromService
{
    public const ENUM_NAME = 'PlaceCategories';

    public function execute(): void
    {
        /** @var PlaceService $service */
        $service = $this->getService(ServiceFactory::PLACE);

        $this->writeEnum(
            $this->generateEnum(
                self::ENUM_NAME,
                array_map(fn (array $mode) => $mode['category'], $service->getPlaceCategories())
            )
        );
    }
}
