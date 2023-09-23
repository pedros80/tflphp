<?php

declare(strict_types=1);

namespace Tests\Unit\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Pedros80\TfLphp\Services\TfLLiftDisruptionService;
use Pedros80\TfLphp\Services\Validator;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

final class TfLLiftDisruptionServiceTest extends TestCase
{
    use ProphecyTrait;

    public function testGetDisruptionsHitsCorrectUrl(): void
    {
        $client = $this->prophesize(Client::class);

        $service = new TfLLiftDisruptionService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $client->get('v2?api_key=api_key')->shouldBeCalled()->willReturn(new Response(body: '{}'));
        $service->getDisruptions();
    }

    public function testGetDisruptionsV1HitsCorrectUrl(): void
    {
        $client = $this->prophesize(Client::class);

        $service = new TfLLiftDisruptionService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $client->get('?api_key=api_key')->shouldBeCalled()->willReturn(new Response(body: '{}'));
        $service->getDisruptions(false);
    }
}
