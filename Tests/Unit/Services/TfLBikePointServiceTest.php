<?php

declare(strict_types=1);

namespace Tests\Unit\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Pedros80\TfLphp\Exceptions\InvalidBikePointId;
use Pedros80\TfLphp\Services\TfLBikePointService;
use Pedros80\TfLphp\Services\Validator;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

final class TfLBikePointServiceTest extends TestCase
{
    use ProphecyTrait;

    public function testGetAllHitsCorrectUrl(): void
    {
        $client  = $this->prophesize(Client::class);
        $service = new TfLBikePointService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $client->get('')->shouldBeCalled()->willReturn(new Response(body: '{}'));
        $service->getAll();
    }

    public function testGetByIdInvalidIdThrowsException(): void
    {
        $this->expectException(InvalidBikePointId::class);
        $this->expectExceptionMessage("'InvalidBikePointId' is not a valid bike point id.");

        $client  = $this->prophesize(Client::class);
        $service = new TfLBikePointService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $service->getById('InvalidBikePointId');
    }

    public function testGetByIdHitsCorrectUrl(): void
    {
        $client  = $this->prophesize(Client::class);
        $service = new TfLBikePointService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $client->get('BikePoints_101?api_key=api_key')->shouldBeCalled()->willReturn(new Response(body: '{}'));
        $service->getById('BikePoints_101');
    }

    public function testSearchHitsCorrectUrl(): void
    {
        $client  = $this->prophesize(Client::class);
        $service = new TfLBikePointService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $client->get('Search?query=BikePoints_101&api_key=api_key')->shouldBeCalled()->willReturn(new Response(body: '{}'));
        $service->search('BikePoints_101');
    }
}
