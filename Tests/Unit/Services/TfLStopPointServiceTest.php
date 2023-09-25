<?php

declare(strict_types=1);

namespace Tests\Unit\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Pedros80\TfLphp\Enums\StopPointModes;
use Pedros80\TfLphp\Exceptions\InvalidPage;
use Pedros80\TfLphp\Exceptions\InvalidSmsCode;
use Pedros80\TfLphp\Exceptions\InvalidStationCode;
use Pedros80\TfLphp\Exceptions\InvalidStopPointMode;
use Pedros80\TfLphp\Exceptions\InvalidStopPointType;
use Pedros80\TfLphp\Exceptions\MethodNotImplemented;
use Pedros80\TfLphp\Exceptions\MissingRequiredPlaceTypes;
use Pedros80\TfLphp\Services\TfLStopPointService;
use Pedros80\TfLphp\Services\Validator;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

final class TfLStopPointServiceTest extends TestCase
{
    use ProphecyTrait;

    public function testGetPlacesByIdAndTypesThrowsExceptionForInvalidNaptan(): void
    {
        $this->expectException(InvalidStationCode::class);
        $this->expectExceptionMessage("'InvalidNaptan' is not a valid station code.");

        $client  = $this->prophesize(Client::class);
        $service = new TfLStopPointService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $service->getPlacesByIdAndTypes('InvalidNaptan');
    }

    public function testGetPlacesByIdAndTypesThrowsExceptionForInvalidTypes(): void
    {
        $this->expectException(InvalidStopPointType::class);
        $this->expectExceptionMessage("'invalid' is not a valid stop point type.");

        $client  = $this->prophesize(Client::class);
        $service = new TfLStopPointService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $service->getPlacesByIdAndTypes('910GBKRVS', ['invalid', 'types']);
    }

    public function testGetPlacesByIdAndTypesThrowsExceptionForMissingTypes(): void
    {
        $this->expectException(MissingRequiredPlaceTypes::class);
        $this->expectExceptionMessage('StopType missing from request.');

        $client  = $this->prophesize(Client::class);
        $service = new TfLStopPointService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $service->getPlacesByIdAndTypes('910GBKRVS');
    }

    public function testGetPlacesByIdAndTypesHitsCorrectUrl(): void
    {
        $client  = $this->prophesize(Client::class);
        $service = new TfLStopPointService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $client->get('910GBKRVS/placeTypes?placeTypes=NaptanFerryEntrance&api_key=api_key')->shouldBeCalled()->willReturn(new Response(body: '{}'));

        $service->getPlacesByIdAndTypes('910GBKRVS', ['NaptanFerryEntrance']);
    }

    public function testGetCarParksByIdInvalidNaptanThrowsException(): void
    {
        $this->expectException(InvalidStationCode::class);
        $this->expectExceptionMessage("'InvalidNaptan' is not a valid station code.");

        $client  = $this->prophesize(Client::class);
        $service = new TfLStopPointService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $service->getCarParksById('InvalidNaptan');
    }

    public function testGetCarParksByIdHitsCorrectUrl(): void
    {
        $client  = $this->prophesize(Client::class);
        $service = new TfLStopPointService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $client->get('910GBKRVS/CarParks?api_key=api_key')->shouldBeCalled()->willReturn(new Response(body: '{}'));

        $service->getCarParksById('910GBKRVS');
    }

    public function testGetDisruptedStopPointsByModeInvalidModeThrowsException(): void
    {
        $this->expectException(InvalidStopPointMode::class);
        $this->expectExceptionMessage("'invalid1' is not a valid stop point mode.");

        $client  = $this->prophesize(Client::class);
        $service = new TfLStopPointService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $service->getDisruptedStopPointsByMode(['invalid1', 'invalid2']);
    }

    public function testGetDisruptedStopPointsByModeHitsCorrectUrl(): void
    {
        $client  = $this->prophesize(Client::class);
        $service = new TfLStopPointService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $client->get('Mode/tube,dlr/Disruption?api_key=api_key')->shouldBeCalled()->willReturn(new Response(body: '{}'));

        $service->getDisruptedStopPointsByMode([StopPointModes::TUBE->value, StopPointModes::DLR->value]);
    }

    public function testGetDisruptedStopPointsByModeIncludeRouteBlockeStopsHitsCorrectUrl(): void
    {
        $client  = $this->prophesize(Client::class);
        $service = new TfLStopPointService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $client->get('Mode/tube,dlr/Disruption?includeRouteBlockedStops=true&api_key=api_key')->shouldBeCalled()->willReturn(new Response(body: '{}'));

        $service->getDisruptedStopPointsByMode([StopPointModes::TUBE->value, StopPointModes::DLR->value], true);
    }

    public function testGetStopPointsByIdInvalidNaptanThrowsException(): void
    {
        $this->expectException(InvalidStationCode::class);
        $this->expectExceptionMessage("'invalid1' is not a valid station code.");

        $client  = $this->prophesize(Client::class);
        $service = new TfLStopPointService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $service->getStopPointsById(['invalid1', 'invalid2']);
    }

    public function testGetStopPointsByIdHitsCorrectUrl(): void
    {
        $client  = $this->prophesize(Client::class);
        $service = new TfLStopPointService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $client->get('910GWOLWXR,910GBKRVS?api_key=api_key')->shouldBeCalled()->willReturn(new Response(body: '{}'));

        $service->getStopPointsById(['910GWOLWXR', '910GBKRVS']);
    }

    public function testGetStopPointsByIdIncludeCrowdingHitsCorrectUrl(): void
    {
        $client  = $this->prophesize(Client::class);
        $service = new TfLStopPointService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $client->get('910GWOLWXR,910GBKRVS?includeCrowdingData=true&api_key=api_key')->shouldBeCalled()->willReturn(new Response(body: '{}'));

        $service->getStopPointsById(['910GWOLWXR', '910GBKRVS'], true);
    }

    public function testGetStopPointsByModeInvalidModesThrowsException(): void
    {
        $this->expectException(InvalidStopPointMode::class);
        $this->expectExceptionMessage("'invalid1' is not a valid stop point mode.");

        $client  = $this->prophesize(Client::class);
        $service = new TfLStopPointService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $service->getStopPointsByMode(['invalid1', 'invalid2']);
    }

    public function testGetStopPointsByModeInvalidPageThrowsException(): void
    {
        $this->expectException(InvalidPage::class);
        $this->expectExceptionMessage("'-100' is not a valid page number.");

        $client  = $this->prophesize(Client::class);
        $service = new TfLStopPointService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $service->getStopPointsByMode([StopPointModes::TUBE->value, StopPointModes::DLR->value], -100);
    }

    public function testGetStopPointsByModeDefaultPageHitsCorrectUrl(): void
    {
        $client  = $this->prophesize(Client::class);
        $service = new TfLStopPointService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $client->get('Mode/tube,dlr?page=1&api_key=api_key')->shouldBeCalled()->willReturn(new Response(body: '{}'));

        $service->getStopPointsByMode([StopPointModes::TUBE->value, StopPointModes::DLR->value]);
    }

    public function testGetStopPointsByModeAndPageHitsCorrectUrl(): void
    {
        $client  = $this->prophesize(Client::class);
        $service = new TfLStopPointService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $client->get('Mode/tube,dlr?page=100&api_key=api_key')->shouldBeCalled()->willReturn(new Response(body: '{}'));

        $service->getStopPointsByMode([StopPointModes::TUBE->value, StopPointModes::DLR->value], 100);
    }

    public function testGetTaxiRanksByIdInvalidNaptanThrowsException(): void
    {
        $this->expectException(InvalidStationCode::class);
        $this->expectExceptionMessage("'InvalidNaptan' is not a valid station code.");

        $client  = $this->prophesize(Client::class);
        $service = new TfLStopPointService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $service->getTaxiRanksById('InvalidNaptan');
    }

    public function testGetTaxiRanksByIdHitsCorrectUrl(): void
    {
        $client  = $this->prophesize(Client::class);
        $service = new TfLStopPointService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $client->get('910GWOLWXR/TaxiRanks?api_key=api_key')->shouldBeCalled()->willReturn(new Response(body: '{}'));

        $service->getTaxiRanksById('910GWOLWXR');
    }

    public function testGetStopPointBySMSCodeInvalidNaptanThrowsException(): void
    {
        $this->expectException(InvalidSmsCode::class);
        $this->expectExceptionMessage("'InvalidNaptan' is not a valid sms code.");

        $client  = $this->prophesize(Client::class);
        $service = new TfLStopPointService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $service->getStopPointBySMSCode('InvalidNaptan');
    }

    public function testGetStopPointBySMSCodeCorrectUrl(): void
    {
        $client  = $this->prophesize(Client::class);
        $service = new TfLStopPointService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $client->get('Sms/50505?api_key=api_key')->shouldBeCalled()->willReturn(new Response(body: '{}'));

        $service->getStopPointBySMSCode('50505');
    }

    public function testSearchPointsByRadiusThrowsException(): void
    {
        $this->expectException(MethodNotImplemented::class);

        $client  = $this->prophesize(Client::class);
        $service = new TfLStopPointService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $service->searchPointsByRadius(123, 123, ['stopTypes']);
    }

    public function testSearchThrowsException(): void
    {
        $this->expectException(MethodNotImplemented::class);

        $client  = $this->prophesize(Client::class);
        $service = new TfLStopPointService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $service->search('query');
    }
}
