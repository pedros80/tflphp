<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Build\Actions;

use Pedros80\TfLphp\Build\Actions\Abstractions\FromService;

final class GenerateLineDisruptionCategories extends FromService
{
    public const ENUM_NAME = 'LineDisruptionCategories';

    public function execute(): void
    {
        $service = $this->getLineService();

        $this->writeEnum(
            $this->generateEnum(
                self::ENUM_NAME,
                $service->getDisruptionCategories(),
            ),
        );
    }
}
