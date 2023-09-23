<?php

declare(strict_types=1);

namespace Tests\Unit;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Pedros80\TfLphp\Services\TfLAirQualityService;
use Pedros80\TfLphp\Services\Validator;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

final class TfLAirQualityServiceTest extends TestCase
{
    use ProphecyTrait;

    public function testGetFeedReturnsKnownType(): void
    {
        $client  = $this->prophesize(Client::class);
        $service = new TfLAirQualityService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $client->get('?api_key=api_key')->shouldBeCalled()->willReturn(new Response(body: '{}'));
        $service->getFeed();
    }
}
