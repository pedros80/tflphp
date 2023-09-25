<?php

namespace Tests\Unit\Factories;

use Pedros80\TfLphp\Exceptions\ServiceNotImplemented;
use Pedros80\TfLphp\Factories\ServiceFactory;
use PHPUnit\Framework\TestCase;

final class ServiceFactoryTest extends TestCase
{
    public function testMakeUnknownThrowsException(): void
    {
        $this->expectException(ServiceNotImplemented::class);
        $this->expectExceptionMessage("'NotImplemented' service not implemented.");

        $factory = new ServiceFactory();

        $factory->makeService('NotImplemented', 'api_key');
    }
}
