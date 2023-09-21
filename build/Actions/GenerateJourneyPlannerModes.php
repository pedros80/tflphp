<?php

declare(strict_types=1);

namespace Pedros80\Build\Actions;

use Pedros80\Build\Actions\Abstractions\FromService;
use Pedros80\TfLphp\Contracts\JourneyService;
use Pedros80\TfLphp\Factories\ServiceFactory;

final class GenerateJourneyPlannerModes extends FromService
{
    public const ENUM_NAME = 'JourneyPlannerModes';

    public function execute(): void
    {
        /** @var JourneyService $service */
        $service = $this->getService(ServiceFactory::JOURNEY);

        $this->writeEnum(
            $this->generateEnum(
                self::ENUM_NAME,
                array_map(fn (array $mode) => $mode['modeName'], $service->getAvailableModes())
            )
        );
    }
}
