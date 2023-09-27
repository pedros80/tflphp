<?php

declare(strict_types=1);

namespace Tests\Unit;

use GuzzleHttp\Client;
use Pedros80\TfLphp\Exceptions\MethodNotImplemented;
use Pedros80\TfLphp\Services\TfLAccidentStatsService;
use Pedros80\TfLphp\Services\Validator;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

final class TfLAccidentStatsServiceTest extends TestCase
{
    use ProphecyTrait;

    public function testGetDetailsThrowsNotImplementedException(): void
    {
        $this->expectException(MethodNotImplemented::class);
        $this->expectExceptionMessage("'AccidentStatsService::getDetails()' method not implemented.");

        $client  = $this->prophesize(Client::class);
        $service = new TfLAccidentStatsService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $service->getDetails(2012);
    }
}
