<?php

declare(strict_types=1);

namespace Tests\Unit\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Pedros80\TfLphp\Exceptions\InvalidDayOfWeek;
use Pedros80\TfLphp\Exceptions\InvalidStationCode;
use Pedros80\TfLphp\Services\TfLCrowdingService;
use Pedros80\TfLphp\Services\Validator;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

final class TfLCrowdingServiceTest extends TestCase
{
    use ProphecyTrait;

    public function testGetByDayOfWeekInvalidNaptanThrowsException(): void
    {
        $this->expectException(InvalidStationCode::class);
        $this->expectExceptionMessage("'InvalidNaptan' is not a valid station code.");

        $client  = $this->prophesize(Client::class);
        $service = new TfLCrowdingService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $service->getByDayOfWeek('InvalidNaptan', 'Mon');
    }

    public function testGetByDayOfWeekInvalidDayThrowsException(): void
    {
        $this->expectException(InvalidDayOfWeek::class);
        $this->expectExceptionMessage("'MONDAY!!' is not a valid day of the week.");

        $client  = $this->prophesize(Client::class);
        $service = new TfLCrowdingService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $service->getByDayOfWeek('910GBKRVS', 'MONDAY!!');
    }

    public function testGetByDayOfWeekHitsCorrectUrl(): void
    {
        $client  = $this->prophesize(Client::class);
        $service = new TfLCrowdingService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $client->get('910GBKRVS/Mon?api_key=api_key')->shouldBeCalled()->willReturn(new Response(body: '{}'));
        $service->getByDayOfWeek('910GBKRVS', 'Mon');
    }

    public function testGetLiveByNaptanInvalidNaptanThrowsException(): void
    {
        $this->expectException(InvalidStationCode::class);
        $this->expectExceptionMessage("'InvalidNaptan' is not a valid station code.");

        $client  = $this->prophesize(Client::class);
        $service = new TfLCrowdingService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $service->getLiveByNaptan('InvalidNaptan');
    }

    public function testGetLiveByNaptanHitsCorrectUrl(): void
    {
        $client  = $this->prophesize(Client::class);
        $service = new TfLCrowdingService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $client->get('910GBKRVS/Live?api_key=api_key')->shouldBeCalled()->willReturn(new Response(body: '{}'));
        $service->getLiveByNaptan('910GBKRVS');
    }

    public function testGetByNaptanInvalidNaptanThrowsException(): void
    {
        $this->expectException(InvalidStationCode::class);
        $this->expectExceptionMessage("'InvalidNaptan' is not a valid station code.");

        $client  = $this->prophesize(Client::class);
        $service = new TfLCrowdingService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $service->getByNaptan('InvalidNaptan');
    }

    public function testGetByNaptanHitsCorrectUrl(): void
    {
        $client  = $this->prophesize(Client::class);
        $service = new TfLCrowdingService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $client->get('910GBKRVS?api_key=api_key')->shouldBeCalled()->willReturn(new Response(body: '{}'));
        $service->getByNaptan('910GBKRVS');
    }
}
