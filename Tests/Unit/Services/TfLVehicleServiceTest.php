<?php

declare(strict_types=1);

namespace Tests\Unit\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Pedros80\TfLphp\Services\TfLVehicleService;
use Pedros80\TfLphp\Services\Validator;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

final class TfLVehicleServiceTest extends TestCase
{
    use ProphecyTrait;

    public function testGetPredictionsHitsCorrectUrl(): void
    {
        $client  = $this->prophesize(Client::class);
        $service = new TfLVehicleService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $client->get('vehicle1,vehicle2/Arrivals?api_key=api_key')->shouldBeCalled()->willReturn(new Response(body: '{}'));

        $service->getPredictions(['vehicle1', 'vehicle2']);
    }
}
