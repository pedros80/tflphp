<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Build\Actions;

use Nette\PhpGenerator\EnumType;
use Pedros80\TfLphp\Build\Actions\Abstractions\FromService;
use Pedros80\TfLphp\Contracts\StopPointService;
use Pedros80\TfLphp\Factories\ServiceFactory;

final class GenerateStopPointInformationCategories extends FromService
{
    public const ENUM_NAME = 'StopPointInformationCategories';

    public function execute(): void
    {
        /** @var StopPointService $service */
        $service = $this->getService(ServiceFactory::STOP_POINT);

        $categories = $service->getInformationCategories();

        $enum = $this->generateEnum(
            self::ENUM_NAME,
            array_map(
                fn (array $category) => $category['category'],
                $categories
            )
        );

        $this->addAvailableKeys($enum, $categories);

        $this->writeEnum($enum);
    }

    private function addAvailableKeys(EnumType $enum, array $categories): void
    {
        $availableKeys = $enum->addMethod('availableKeys')->setReturnType('array');

        $availableKeys->addBody('return match($this) {');
        foreach ($categories as $category) {
            sort($category['availableKeys']);
            $keys = implode(
                ', ',
                array_map(fn (string $key) =>  "'{$key}'", $category['availableKeys'])
            );
            $availableKeys->addBody("self::{$this->getConstFromString($category['category'])} => [{$keys}],");
        }
        $availableKeys->addBody('};');
    }
}
