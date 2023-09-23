<?php

declare(strict_types=1);

namespace Tets\Unit\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Pedros80\TfLphp\Exceptions\MethodNotImplemented;
use Pedros80\TfLphp\Services\TfLJourneyService;
use Pedros80\TfLphp\Services\Validator;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

final class TfLJourneyServiceTest extends TestCase
{
    use ProphecyTrait;

    public function testGetAvailableModesHitsCorrectUrl(): void
    {
        $client  = $this->prophesize(Client::class);
        $service = new TfLJourneyService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $client->get('Meta/Modes?api_key=api_key')->shouldBeCalled()->willReturn(new Response(body: '{}'));
        $service->getAvailableModes();
    }

    public function testSearchNotYetImpolmented(): void
    {
        $this->expectException(MethodNotImplemented::class);

        $service = new TfLJourneyService(
            'api_key',
            $this->prophesize(Client::class)->reveal(),
            new Validator()
        );

        $service->search('from', 'to');
    }
}
