<?php

declare(strict_types=1);

namespace Tests\Unit\Services;

use DateTime;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Pedros80\TfLphp\Enums\Directions;
use Pedros80\TfLphp\Enums\LineModes;
use Pedros80\TfLphp\Enums\Lines;
use Pedros80\TfLphp\Enums\TubeDisruptionSeverities;
use Pedros80\TfLphp\Exceptions\InvalidDateTime;
use Pedros80\TfLphp\Exceptions\InvalidDirection;
use Pedros80\TfLphp\Exceptions\InvalidLine;
use Pedros80\TfLphp\Exceptions\InvalidLineMode;
use Pedros80\TfLphp\Exceptions\InvalidLineSeverityCode;
use Pedros80\TfLphp\Exceptions\InvalidRoute;
use Pedros80\TfLphp\Exceptions\InvalidStationCode;
use Pedros80\TfLphp\Services\TfLLineService;
use Pedros80\TfLphp\Services\Validator;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

final class TfLLineServiceTest extends TestCase
{
    use ProphecyTrait;

    public function testGetRoutesHitsCorrectUrl(): void
    {
        $client  = $this->prophesize(Client::class);
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
        $client  = $this->prophesize(Client::class);
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
        $client  = $this->prophesize(Client::class);
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

        $client  = $this->prophesize(Client::class);
        $service = new TfLLineService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $service->getRoutes(['InvalidLine']);
    }

    public function testGetDisruptionsForAllLinesHitsCorrectUrl(): void
    {
        $client  = $this->prophesize(Client::class);
        $service = new TfLLineService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $client->get('Mode/bus,dlr/Disruption')->shouldBeCalled()->willReturn(new Response(body: '{}'));
        $service->getDisruptionsForAllLines([LineModes::BUS->value, LineModes::DLR->value]);
    }

    public function testGetDisruptionsForAllLinesInvalidModesThrowsException(): void
    {
        $this->expectException(InvalidLineMode::class);
        $this->expectExceptionMessage("'InvalidMode' is not a valid line mode.");

        $client  = $this->prophesize(Client::class);
        $service = new TfLLineService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $service->getDisruptionsForAllLines(['InvalidMode']);
    }

    public function testGetDisruptionsForLinesHitsCorrectUrl(): void
    {
        $client  = $this->prophesize(Client::class);
        $service = new TfLLineService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $client->get('bakerloo,elizabeth/Disruption')->shouldBeCalled()->willReturn(new Response(body: '{}'));
        $service->getDisruptionsForLines([Lines::BAKERLOO->value, Lines::ELIZABETH->value]);
    }

    public function testGetDisruptionsForLinesInvalidRouteThrowsException(): void
    {
        $this->expectException(InvalidLine::class);
        $this->expectExceptionMessage("'InvalidLine' is not a valid line.");

        $client  = $this->prophesize(Client::class);
        $service = new TfLLineService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $service->getDisruptionsForLines(['InvalidLine']);
    }

    public function testGetArrivalsByLineHitsCorrectUrl(): void
    {
        $client  = $this->prophesize(Client::class);
        $service = new TfLLineService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $client->get('bakerloo,elizabeth/Arrivals?api_key=api_key')->shouldBeCalled()->willReturn(new Response(body: '{}'));
        $service->getArrivalsByLine([Lines::BAKERLOO->value, Lines::ELIZABETH->value]);
    }

    public function testGetArrivalsByLineInvalidModesThrowsException(): void
    {
        $this->expectException(InvalidRoute::class);
        $this->expectExceptionMessage("'InvalidRoute' is not a valid route.");

        $client  = $this->prophesize(Client::class);
        $service = new TfLLineService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $service->getArrivalsByLine(['InvalidRoute']);
    }

    public function testGetArrivalsByLineAndStopInvalidLineThrowsException(): void
    {
        $this->expectException(InvalidLine::class);
        $this->expectExceptionMessage("'InvalidLine' is not a valid line.");

        $client  = $this->prophesize(Client::class);
        $service = new TfLLineService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $service->getArrivalsByLineAndStop(['InvalidLine'], '910GBKRVS');
    }

    public function testGetArrivalsByLineAndStopInvalidStopPointIdThrowsException(): void
    {
        $this->expectException(InvalidStationCode::class);
        $this->expectExceptionMessage("'InvalidStopId' is not a valid station code.");

        $client  = $this->prophesize(Client::class);
        $service = new TfLLineService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $service->getArrivalsByLineAndStop([Lines::BAKERLOO->value], 'InvalidStopId');
    }

    public function testGetArrivalsByLineAndStopInvalidDirectionThrowsException(): void
    {
        $this->expectException(InvalidDirection::class);
        $this->expectExceptionMessage("'InvalidDirection' is not a valid direction.");

        $client  = $this->prophesize(Client::class);
        $service = new TfLLineService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $service->getArrivalsByLineAndStop([Lines::BAKERLOO->value], '910GBKRVS', 'InvalidDirection');
    }

    public function testGetArrivalsByLineAndStopInvalidDestinationStopIdThrowsException(): void
    {
        $this->expectException(InvalidStationCode::class);
        $this->expectExceptionMessage("'InvalidStationId' is not a valid station code.");

        $client  = $this->prophesize(Client::class);
        $service = new TfLLineService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $service->getArrivalsByLineAndStop(
            routes: [Lines::BAKERLOO->value],
            stopPointId: '910GBKRVS',
            destinationStationId: 'InvalidStationId'
        );
    }

    public function testGetArrivalsByLineAndStopHitsCorrectUrl(): void
    {
        $client  = $this->prophesize(Client::class);
        $service = new TfLLineService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $client->get('bakerloo,elizabeth/Arrivals/910GBKRVS?api_key=api_key')
            ->shouldBeCalled()
            ->willReturn(new Response(body: '{}'));

        $service->getArrivalsByLineAndStop(
            routes: [Lines::BAKERLOO->value, Lines::ELIZABETH->value],
            stopPointId: '910GBKRVS'
        );
    }

    public function testGetArrivalsByLineAndStopWithDirectionHitsCorrectUrl(): void
    {
        $client  = $this->prophesize(Client::class);
        $service = new TfLLineService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $client->get('bakerloo,elizabeth/Arrivals/910GBKRVS?direction=inbound&api_key=api_key')
            ->shouldBeCalled()
            ->willReturn(new Response(body: '{}'));

        $service->getArrivalsByLineAndStop(
            routes: [Lines::BAKERLOO->value, Lines::ELIZABETH->value],
            stopPointId: '910GBKRVS',
            direction: Directions::INBOUND->value
        );
    }

    public function testGetArrivalsByLineAndStopWithDestinationHitsCorrectUrl(): void
    {
        $client  = $this->prophesize(Client::class);
        $service = new TfLLineService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $client->get('bakerloo,elizabeth/Arrivals/910GBKRVS?destinationStationId=910GWOLWXR&api_key=api_key')
            ->shouldBeCalled()
            ->willReturn(new Response(body: '{}'));

        $service->getArrivalsByLineAndStop(
            routes: [Lines::BAKERLOO->value, Lines::ELIZABETH->value],
            stopPointId: '910GBKRVS',
            destinationStationId: '910GWOLWXR'
        );
    }

    public function testGetServingStationsInvalidLineThrowsException(): void
    {
        $this->expectException(InvalidLine::class);
        $this->expectExceptionMessage("'InvalidLine' is not a valid line.");

        $client  = $this->prophesize(Client::class);
        $service = new TfLLineService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $service->getServingStations('InvalidLine');
    }

    public function testGetServingStationsHitsCorrectUrl(): void
    {
        $client  = $this->prophesize(Client::class);
        $service = new TfLLineService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $client->get('circle/StopPoints?api_key=api_key')->shouldBeCalled()->willReturn(new Response(body: '{}'));
        $service->getServingStations(Lines::CIRCLE->value);
    }

    public function testGetServingStationsTfLOnlyHitsCorrectUrl(): void
    {
        $client  = $this->prophesize(Client::class);
        $service = new TfLLineService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $client->get('circle/StopPoints?tflOperatedNationalRailStationsOnly=true&api_key=api_key')->shouldBeCalled()->willReturn(new Response(body: '{}'));
        $service->getServingStations(Lines::CIRCLE->value, true);
    }

    public function testMetaMethodsHitCorrectUrl(): void
    {
        $methods = [
            ['path' => 'DisruptionCategories'],
            ['path' => 'Modes'],
            ['path' => 'ServiceTypes'],
            ['path' => 'Severity', 'method' => 'getSeverityCodes'],
        ];

        $client  = $this->prophesize(Client::class);
        $service = new TfLLineService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        foreach ($methods as $data) {
            $method = $data['method'] ?? "get{$data['path']}";

            $client->get("Meta/{$data['path']}?api_key=api_key")->shouldBeCalled()->willReturn(new Response(body: '{}'));
            $service->$method();
        }
    }

    public function testGetLinesAndRoutesForModeInvalidModeThrowsException(): void
    {
        $this->expectException(InvalidLineMode::class);
        $this->expectExceptionMessage("'InvalidMode' is not a valid line mode.");

        $client  = $this->prophesize(Client::class);
        $service = new TfLLineService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $service->getLinesAndRoutesForMode(['InvalidMode']);
    }

    public function testGetLinesAndRoutesForModeHitsCorrectUrl(): void
    {
        $client  = $this->prophesize(Client::class);
        $service = new TfLLineService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $client->get('Mode/bus/Route?api_key=api_key')->shouldBeCalled()->willReturn(new Response(body: '{}'));
        $service->getLinesAndRoutesForMode([LineModes::BUS->value]);
    }

    public function testGetLinesAndRoutesForModeNightServiceTypesHitsCorrectUrl(): void
    {
        $client  = $this->prophesize(Client::class);
        $service = new TfLLineService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $client->get('Mode/bus/Route?serviceTypes=Night&api_key=api_key')->shouldBeCalled()->willReturn(new Response(body: '{}'));
        $service->getLinesAndRoutesForMode([LineModes::BUS->value], true);
    }

    public function testGetRoutesForLineInvalidLineThrowsException(): void
    {
        $this->expectException(InvalidLine::class);
        $this->expectExceptionMessage("'InvalidLine' is not a valid line.");

        $client  = $this->prophesize(Client::class);
        $service = new TfLLineService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $service->getRoutesForLine('InvalidLine', Directions::INBOUND->value);
    }

    public function testGetRoutesForLineInvalidDirectionThrowsException(): void
    {
        $this->expectException(InvalidDirection::class);
        $this->expectExceptionMessage("'InvalidDirection' is not a valid direction.");

        $client  = $this->prophesize(Client::class);
        $service = new TfLLineService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $service->getRoutesForLine(Lines::DISTRICT->value, 'InvalidDirection');
    }

    public function testGetRoutesForLineHitsCorrectUtl(): void
    {
        $client  = $this->prophesize(Client::class);
        $service = new TfLLineService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $client->get('district/Route/Sequence/inbound?api_key=api_key')->shouldBeCalled()->willReturn(new Response(body: '{}'));
        $service->getRoutesForLine(Lines::DISTRICT->value, Directions::INBOUND->value);
    }

    public function testGetRoutesForLineNightServicesHitsCorrectUtl(): void
    {
        $client  = $this->prophesize(Client::class);
        $service = new TfLLineService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $client->get('district/Route/Sequence/inbound?serviceTypes=Night&api_key=api_key')->shouldBeCalled()->willReturn(new Response(body: '{}'));
        $service->getRoutesForLine(
            line: Lines::DISTRICT->value,
            direction: Directions::INBOUND->value,
            night: true
        );
    }

    public function testGetRoutesForLineExcludeCrowdingHitsCorrectUrl(): void
    {
        $client  = $this->prophesize(Client::class);
        $service = new TfLLineService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $client->get('district/Route/Sequence/inbound?excludeCrowding=true&api_key=api_key')->shouldBeCalled()->willReturn(new Response(body: '{}'));
        $service->getRoutesForLine(
            line: Lines::DISTRICT->value,
            direction: Directions::INBOUND->value,
            excludeCrowding: true
        );
    }

    public function testGetLinesByIdInvalidLineThrowsException(): void
    {
        $this->expectException(InvalidLine::class);
        $this->expectExceptionMessage("'InvalidLine' is not a valid line.");

        $client  = $this->prophesize(Client::class);
        $service = new TfLLineService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $service->getLinesById(['InvalidLine']);
    }

    public function testGetLinesByIdHitsCorrectUrl(): void
    {
        $client  = $this->prophesize(Client::class);
        $service = new TfLLineService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $client->get('bakerloo,central?api_key=api_key')->shouldBeCalled()->willReturn(new Response(body: '{}'));
        $service->getLinesById([Lines::BAKERLOO->value, Lines::CENTRAL->value]);
    }

    public function testGetLinesByModeInvalidLineThrowsException(): void
    {
        $this->expectException(InvalidLineMode::class);
        $this->expectExceptionMessage("'InvalidLineMode' is not a valid line mode.");

        $client  = $this->prophesize(Client::class);
        $service = new TfLLineService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $service->getLinesByMode(['InvalidLineMode']);
    }

    public function testGetLinesByModeHitsCorrectUrl(): void
    {
        $client  = $this->prophesize(Client::class);
        $service = new TfLLineService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $client->get('Mode/bus?api_key=api_key')->shouldBeCalled()->willReturn(new Response(body: '{}'));
        $service->getLinesByMode([LineModes::BUS->value]);
    }

    public function testGetLineStatusBySeverityInvalidSeverityThrowsException(): void
    {
        $this->expectException(InvalidLineSeverityCode::class);
        $this->expectExceptionMessage("'999' is not a valid line severity code.");

        $client  = $this->prophesize(Client::class);
        $service = new TfLLineService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $service->getLineStatusBySeverity(999);
    }

    public function testGetLineStatusBySeverityHitsCorrectUrl(): void
    {
        $client  = $this->prophesize(Client::class);
        $service = new TfLLineService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $client->get('Status/1?api_key=api_key')->shouldBeCalled()->willReturn(new Response(body: '{}'));
        $service->getLineStatusBySeverity(TubeDisruptionSeverities::CLOSED->value);
    }

    public function testGetLineStatusByPeriodInvalidLineThrowsException(): void
    {
        $this->expectException(InvalidLine::class);
        $this->expectExceptionMessage("'InvalidLine' is not a valid line.");

        $client  = $this->prophesize(Client::class);
        $service = new TfLLineService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $service->getLineStatusByPeriod(
            ['InvalidLine'],
            date(DateTime::RFC3339, strtotime('-1 week')),
            date(DateTime::RFC3339)
        );
    }

    public function testGetLineStatusByPeriodInvalidDateFromThrowsException(): void
    {
        $this->expectException(InvalidDateTime::class);
        $this->expectExceptionMessage("'last week' is not a valid RFC3339 date time.");

        $client  = $this->prophesize(Client::class);
        $service = new TfLLineService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $service->getLineStatusByPeriod(
            [Lines::CENTRAL->value],
            'last week',
            date(DateTime::RFC3339)
        );
    }

    public function testGetLineStatusByPeriodInvalidDateToThrowsException(): void
    {
        $this->expectException(InvalidDateTime::class);
        $this->expectExceptionMessage("'last week' is not a valid RFC3339 date time.");

        $client  = $this->prophesize(Client::class);
        $service = new TfLLineService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $service->getLineStatusByPeriod(
            [Lines::CENTRAL->value],
            date(DateTime::RFC3339),
            'last week'
        );
    }

    public function testGetLineStatusByPeriodHitsCorrectUrl(): void
    {
        $client  = $this->prophesize(Client::class);
        $service = new TfLLineService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $from = date(DateTime::RFC3339, strtotime('-1 week'));
        $to   = date(DateTime::RFC3339);

        $client->get("circle/Status/{$from}/to/{$to}?detail=true&api_key=api_key")
            ->shouldBeCalled()
            ->willReturn(new Response(body: '{}'));

        $service->getLineStatusByPeriod([Lines::CIRCLE->value], $from, $to);
    }

    public function testGetLineStatusByPeriodNoDetailHitsCorrectUrl(): void
    {
        $client  = $this->prophesize(Client::class);
        $service = new TfLLineService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $from = date(DateTime::RFC3339, strtotime('-1 week'));
        $to   = date(DateTime::RFC3339);

        $client->get("circle/Status/{$from}/to/{$to}?detail=false&api_key=api_key")
            ->shouldBeCalled()
            ->willReturn(new Response(body: '{}'));

        $service->getLineStatusByPeriod([Lines::CIRCLE->value], $from, $to, false);
    }
}
