<?php

declare(strict_types=1);

namespace Pedros80\Build\Actions;

use Nette\PhpGenerator\EnumType;
use Pedros80\Build\Actions\Abstractions\FromDataFile;

final class GenerateLines extends FromDataFile
{
    private const CSV       = 'ModesAndLines';
    private const ENUM_NAME = 'Lines';

    public function execute(): void
    {
        $data = array_slice($this->getCsv(self::CSV), 1);

        $values = array_map(
            fn (array $row) => $row[1],
            $data
        );
        $enum = $this->generateEnum(self::ENUM_NAME, $values);

        $this->addToMode($enum, $data);

        $this->writeEnum($enum);
    }

    private function addToMode(EnumType $enum, array $data): void
    {
        $cased = array_map(
            fn (array $row) => [$row[0], $this->getConstFromString($row[1])],
            $data
        );

        $toMode = $enum->addMethod('toMode')->setReturnType('string');

        $toMode->addBody('return match($this) {');
        foreach ($cased as $case) {
            $toMode->addBody("self::{$case[1]} => '{$case[0]}',");
        }
        $toMode->addBody('};');
    }
}
