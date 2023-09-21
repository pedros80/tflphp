<?php

declare(strict_types=1);

namespace Pedros80\Build\Actions;

use Pedros80\Build\Actions\Abstractions\FromService;
use Pedros80\TfLphp\Contracts\LineService;
use Pedros80\TfLphp\Factories\ServiceFactory;

final class GenerateLineModes extends FromService
{
    public const ENUM_NAME = 'LineModes';

    public function execute(): void
    {
        /** @var LineService $service */
        $service = $this->getService(ServiceFactory::LINE);

        $this->writeEnum(
            $this->generateEnum(
                self::ENUM_NAME,
                array_map(fn (array $mode) => $mode['modeName'], $service->getModes())
            )
        );
    }
}
