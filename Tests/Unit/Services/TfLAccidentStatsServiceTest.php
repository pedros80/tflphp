<?php

namespace Tests\Unit;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Pedros80\TfLphp\Services\TfLAccidentStatsService;
use Pedros80\TfLphp\Services\Validator;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

final class TfLAccidentStatsServiceTest extends TestCase
{
    use ProphecyTrait;

    public function testGetFeedReturnsKnownType(): void
    {
        $client  = $this->prophesize(Client::class);
        $service = new TfLAccidentStatsService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $client->get('2012?api_key=api_key')->shouldBeCalled()->willReturn(new Response(body: '{}'));
        $service->getDetails(2012);
    }
}
