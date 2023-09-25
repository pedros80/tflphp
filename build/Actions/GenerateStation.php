<?php

declare(strict_types=1);

namespace Pedros80\Build\Actions;

use Nette\PhpGenerator\ClassType;
use Pedros80\Build\Actions\Abstractions\FromDataFile;
use Pedros80\TfLphp\Exceptions\InvalidStationCode;

final class GenerateStation extends FromDataFile
{
    private const CSV        = 'Stations';
    private const CLASS_NAME = 'Station';

    public function execute(): void
    {
        $stations = $this->getStations();

        $this->writeParam(self::CLASS_NAME, $this->getClass($stations), [InvalidStationCode::class]);
    }

    private function getStations(): array
    {
        return array_map(
            fn (array $row) => [
                'id'   => $row[0],
                'name' => $row[1],
            ],
            array_slice($this->getCsv(self::CSV), 1)
        );
    }

    private function getClass(array $stations): ClassType
    {
        $class = new ClassType(self::CLASS_NAME);
        $class->setFinal();

        $this->addValid($stations, $class);
        $this->addConstructor($class);
        $this->addToString($class);
        $this->addNameMethod($class);

        return $class;
    }

    private function addValid(array $stations, ClassType $class): void
    {
        $codes = array_reduce(
            $stations,
            function (array $codes, array $station) {
                $codes[(string) $station['id']] = $station['name'];

                return $codes;
            },
            []
        );

        $class->addConstant('VALID', $codes)->setPrivate();
    }

    private function addConstructor(ClassType $class): void
    {
        $constructor = $class->addMethod('__construct');
        $constructor->addPromotedParameter('code')->setType('string')->setPrivate();
        $constructor->setBody("if (!in_array(\$code, array_keys(self::VALID))) {\n\t\tthrow InvalidStationCode::fromCode(\$code);\n\t}");
    }

    private function addToString(ClassType $class): void
    {
        $toString = $class->addMethod('__toString')->setReturnType('string');
        $toString->setBody('return $this->code;');
    }

    private function addNameMethod(ClassType $class): void
    {
        $name = $class->addMethod('name')->setReturnType('string');
        $name->setBody('return self::VALID[$this->code];');
    }
}
