<?php

declare(strict_types=1);

namespace Tests\Unit\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Pedros80\TfLphp\Enums\LineModes;
use Pedros80\TfLphp\Exceptions\InvalidCount;
use Pedros80\TfLphp\Exceptions\InvalidLineMode;
use Pedros80\TfLphp\Services\TfLModeService;
use Pedros80\TfLphp\Services\Validator;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

final class TfLModeServiceTest extends TestCase
{
    use ProphecyTrait;

    public function testGetArrivalPredictionsInvalidModeThrowsException(): void
    {
        $this->expectException(InvalidLineMode::class);
        $this->expectExceptionMessage("'InvalidMode' is not a valid line mode.");

        $client  = $this->prophesize(Client::class);
        $service = new TfLModeService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $service->getArrivalPredictions('InvalidMode');
    }

    public function testGetArrivalPredictionsInvalidCountThrowsException(): void
    {
        $this->expectException(InvalidCount::class);
        $this->expectExceptionMessage("'-100' is not a valid count.");

        $client  = $this->prophesize(Client::class);
        $service = new TfLModeService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $service->getArrivalPredictions(LineModes::BUS->value, -100);
    }

    public function testGetArrivalPredictionsHitsCorrectUrl(): void
    {
        $client  = $this->prophesize(Client::class);
        $service = new TfLModeService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $client->get('bus/Arrivals?count=10')->shouldBeCalled()->willReturn(new Response(body: '{}'));
        $service->getArrivalPredictions(LineModes::BUS->value, 10);
    }

    public function testGetActiveServiceTypesHitsCorrectUrl(): void
    {
        $client  = $this->prophesize(Client::class);
        $service = new TfLModeService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $client->get('ActiveServiceTypes?api_key=api_key')->shouldBeCalled()->willReturn(new Response(body: '{}'));
        $service->getActiveServiceType();
    }
}
