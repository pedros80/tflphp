<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Build\Actions;

use Pedros80\TfLphp\Build\Actions\Abstractions\FromService;

final class GenerateLineModes extends FromService
{
    public const ENUM_NAME = 'LineModes';

    public function execute(): void
    {
        $service = $this->getLineService();

        $this->writeEnum(
            $this->generateEnum(
                self::ENUM_NAME,
                array_map(fn (array $mode) => $mode['modeName'], $service->getModes()),
            ),
        );
    }
}
