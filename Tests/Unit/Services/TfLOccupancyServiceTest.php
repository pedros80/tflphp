<?php

declare(strict_types=1);

namespace Tests\Unit\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Pedros80\TfLphp\Exceptions\InvalidBikePointId;
use Pedros80\TfLphp\Exceptions\InvalidCarParkId;
use Pedros80\TfLphp\Services\TfLOccupancyService;
use Pedros80\TfLphp\Services\Validator;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

final class TfLOccupancyServiceTest extends TestCase
{
    use ProphecyTrait;

    public function testGetOccupancyForBikePointInvalidIdThrowsException(): void
    {
        $this->expectException(InvalidBikePointId::class);
        $this->expectExceptionMessage("'InvalidBikePointId' is not a valid bike point id.");

        $client  = $this->prophesize(Client::class);
        $service = new TfLOccupancyService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $service->getOccupancyForBikePoint('InvalidBikePointId');
    }

    public function testGetOccupancyForBikePointHitsCorrectUrl(): void
    {
        $client  = $this->prophesize(Client::class);
        $service = new TfLOccupancyService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $client->get('BikePoints/BikePoints_101?api_key=api_key')->shouldBeCalled()->willReturn(new Response(body: '{}'));
        $service->getOccupancyForBikePoint('BikePoints_101');
    }

    public function testGetOccupancyForCarParkInvalidIdThrowsException(): void
    {
        $this->expectException(InvalidCarParkId::class);
        $this->expectExceptionMessage("'InvalidCarParkId' is not a valid car park id.");

        $client  = $this->prophesize(Client::class);
        $service = new TfLOccupancyService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $service->getOccupancyForCarPark('InvalidCarParkId');
    }

    public function testGetOccupancyForCarParkHitsCorrectUrl(): void
    {
        $client  = $this->prophesize(Client::class);
        $service = new TfLOccupancyService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $client->get('CarPark/CarParks_101?api_key=api_key')->shouldBeCalled()->willReturn(new Response(body: '{}'));
        $service->getOccupancyForCarPark('CarParks_101');
    }

    public function testGetOccupancyForAllCarParksHitsCorrectUrl(): void
    {
        $client  = $this->prophesize(Client::class);
        $service = new TfLOccupancyService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $client->get('CarPark?api_key=api_key')->shouldBeCalled()->willReturn(new Response(body: '{}'));
        $service->getOccupancyForAllCarParks();
    }

    public function testGetOccupancyForChargeConnectorHitsCorrectUrl(): void
    {
        $client  = $this->prophesize(Client::class);
        $service = new TfLOccupancyService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $client->get('ChargeConnector/ChargeId?api_key=api_key')->shouldBeCalled()->willReturn(new Response(body: '{}'));
        $service->getOccupancyForChargeConnector('ChargeId');
    }

    public function testGetOccupancyForAllChargeConnectorsHitsCorrectUrl(): void
    {
        $client  = $this->prophesize(Client::class);
        $service = new TfLOccupancyService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $client->get('ChargeConnector?api_key=api_key')->shouldBeCalled()->willReturn(new Response(body: '{}'));
        $service->getOccupancyForAllChargeConnectors();
    }
}
