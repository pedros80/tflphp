<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Build\Actions;

use Pedros80\TfLphp\Build\Actions\Abstractions\FromService;
use Pedros80\TfLphp\Contracts\LineService;
use Pedros80\TfLphp\Factories\ServiceFactory;

final class GenerateSeverityCodes extends FromService
{
    public const ENUM_NAME = 'LineSeverityCodes';

    public function execute(): void
    {
        $severitiesByType = $this->getSeveritiesByType();

        foreach ($severitiesByType as $type => $severities) {
            $this->writeEnum($this->generateEnum($this->getEnumNameFromType($type), $severities, true));
        }
    }

    private function getEnumNameFromType(string $type): string
    {
        if ($type === 'dlr') {
            return 'DLRSeverityCodes';
        }

        $type = str_replace('-', ' ', $type);
        $type = ucwords($type);
        $type = str_replace(' ', '', $type);

        return "{$type}DisruptionSeverities";
    }

    private function getSeveritiesByType(): array
    {
        /** @var LineService $service */
        $service = $this->getService(ServiceFactory::LINE);

        return array_reduce(
            $service->getSeverityCodes(),
            function (array $severities, array $severity) {
                if (!isset($severities[$severity['modeName']])) {
                    $severities[$severity['modeName']] = [];
                }
                $severities[$severity['modeName']][$this->getConstFromString($severity['description'])] = $severity['severityLevel'];

                return $severities;
            },
            []
        );
    }
}
