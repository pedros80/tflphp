<?php

declare(strict_types=1);

namespace Tests\Unit\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Pedros80\TfLphp\Enums\Lines;
use Pedros80\TfLphp\Exceptions\InvalidLine;
use Pedros80\TfLphp\Services\TfLLineService;
use Pedros80\TfLphp\Services\Validator;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

final class TfLLineServiceTest extends TestCase
{
    use ProphecyTrait;

    public function testGetRoutesHitsCorrectUrl(): void
    {
        $client = $this->prophesize(Client::class);
        $service = new TfLLineService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $client->get('Route?api_key=api_key')->shouldBeCalled()->willReturn(new Response(body: '{}'));
        $service->getRoutes();
    }

    public function testGetRoutesNightServicesHitsCorrectUrl(): void
    {
        $client = $this->prophesize(Client::class);
        $service = new TfLLineService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $client->get('Route?serviceTypes=Night&api_key=api_key')->shouldBeCalled()->willReturn(new Response(body: '{}'));
        $service->getRoutes([], true);
    }

    public function testGetRoutesLinesHitsCorrectUrl(): void
    {
        $client = $this->prophesize(Client::class);
        $service = new TfLLineService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $client->get('elizabeth,bakerloo/Route?api_key=api_key')->shouldBeCalled()->willReturn(new Response(body: '{}'));
        $service->getRoutes([Lines::ELIZABETH->value, Lines::BAKERLOO->value]);
    }

    public function testGetRoutesInvalidLineThrowsException(): void
    {
        $this->expectException(InvalidLine::class);
        $this->expectExceptionMessage("'InvalidLine' is not a valid line.");

        $client = $this->prophesize(Client::class);
        $service = new TfLLineService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $service->getRoutes(['InvalidLine']);
    }
}
