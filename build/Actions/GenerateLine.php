<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Build\Actions;

use Nette\PhpGenerator\ClassType;
use Pedros80\TfLphp\Build\Actions\Abstractions\FromService;
use Pedros80\TfLphp\Contracts\LineService;
use Pedros80\TfLphp\Exceptions\InvalidLine;
use Pedros80\TfLphp\Factories\ServiceFactory;

final class GenerateLine extends FromService
{
    private const CLASS_NAME = 'Line';

    public function execute(): void
    {
        /** @var LineService $service */
        $service = $this->getService(ServiceFactory::LINE);

        $lines = $this->getParsedLines($service->getRoutes());

        $this->writeParam(self::CLASS_NAME, $this->getClass($lines), [InvalidLine::class]);
    }

    private function getParsedLines(array $lines): array
    {
        $parsed = array_reduce(
            $lines,
            function (array $lines, array $line) {
                $lines[(string) $line['id']] = ['mode' => $line['modeName'], 'name' => $line['name']];

                return $lines;
            },
            []
        );

        asort($parsed);

        return $parsed;
    }

    private function getClass(array $lines): ClassType
    {
        $class = new ClassType(self::CLASS_NAME);
        $class->setFinal();
        $class->addConstant('VALID', $lines)->setPrivate();

        $this->addConstructor($class);
        $this->addToString($class);
        $this->addNameMethod($class);
        $this->addModeMethod($class);
        $this->addBusMethod($class);
        $this->addTubeMethod($class);

        return $class;
    }

    private function addConstructor(ClassType $class): void
    {
        $constructor = $class->addMethod('__construct');
        $constructor->addPromotedParameter('id')->setType('string')->setPrivate();
        $constructor->setBody("if (!in_array(\$id, array_keys(self::VALID))) {\n\t\tthrow InvalidLine::fromString((string) \$id);\n\t}");
    }

    private function addToString(ClassType $class): void
    {
        $toString = $class->addMethod('__toString')->setReturnType('string');
        $toString->setBody('return (string) $this->id;');
    }

    private function addNameMethod(ClassType $class): void
    {
        $name = $class->addMethod('name')->setReturnType('string');
        $name->setBody('return self::VALID[$this->id][\'name\'];');
    }

    private function addModeMethod(ClassType $class): void
    {
        $name = $class->addMethod('mode')->setReturnType('string');
        $name->setBody('return self::VALID[$this->id][\'mode\'];');
    }

    private function addBusMethod(ClassType $class): void
    {
        $name = $class->addMethod('bus')->setStatic()->setReturnType('array');
        $name->setBody('return array_filter(self::VALID, fn (array $line) => $line[\'mode\'] === \'bus\');');
    }

    private function addTubeMethod(ClassType $class): void
    {
        $name = $class->addMethod('tube')->setStatic()->setReturnType('array');
        $name->setBody('return array_filter(self::VALID, fn (array $line) => $line[\'mode\'] === \'tube\');');
    }
}
