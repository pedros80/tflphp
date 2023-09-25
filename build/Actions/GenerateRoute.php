<?php

declare(strict_types=1);

namespace Pedros80\Build\Actions;

use Nette\PhpGenerator\ClassType;
use Pedros80\Build\Actions\Abstractions\FromService;
use Pedros80\TfLphp\Exceptions\InvalidRoute;
use Pedros80\TfLphp\Exceptions\InvalidStationCode;
use Pedros80\TfLphp\Factories\ServiceFactory;

final class GenerateRoute extends FromService
{
    private const CLASS_NAME = 'Route';

    public function execute(): void
    {
        /** @var LineService $service */
        $service = $this->getService(ServiceFactory::LINE);

        $routes = $this->getParsedRoutes($service->getRoutes());

        $this->writeParam(self::CLASS_NAME, $this->getClass($routes), [InvalidRoute::class]);
    }

    private function getParsedRoutes(array $routes): array
    {
        $parsed = array_reduce(
            $routes,
            function (array $routes, array $route) {
                $routes[(string) $route['id']] = ['mode' => $route['modeName'], 'name' => $route['name']];

                return $routes;
            },
            []
        );

        asort($parsed);

        return $parsed;
    }

    private function getClass(array $routes): ClassType
    {
        $class = new ClassType(self::CLASS_NAME);
        $class->setFinal();
        $class->addConstant('VALID', $routes)->setPrivate();

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
        $constructor->setBody("if (!in_array(\$id, array_keys(self::VALID))) {\n\t\tthrow InvalidRoute::fromString((string) \$id);\n\t}");
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
        $name->setBody('return array_filter(self::VALID, fn (array $route) => $route[\'mode\'] === \'bus\');');
    }

    private function addTubeMethod(ClassType $class): void
    {
        $name = $class->addMethod('tube')->setStatic()->setReturnType('array');
        $name->setBody('return array_filter(self::VALID, fn (array $route) => $route[\'mode\'] === \'tube\');');
    }
}
