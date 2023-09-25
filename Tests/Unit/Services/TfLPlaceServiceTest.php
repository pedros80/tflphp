<?php

declare(strict_types=1);

namespace Tests\Unit\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Pedros80\TfLphp\Exceptions\InvalidPlaceType;
use Pedros80\TfLphp\Exceptions\MethodNotImplemented;
use Pedros80\TfLphp\Services\TfLPlaceService;
use Pedros80\TfLphp\Services\Validator;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

final class TfLPlaceServiceTest extends TestCase
{
    use ProphecyTrait;

    public function testGetPlaceCategoriesHitsCorrectUrl(): void
    {
        $client  = $this->prophesize(Client::class);
        $service = new TfLPlaceService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $client->get('Meta/Categories?api_key=api_key')->shouldBeCalled()->willReturn(new Response(body: '{}'));
        $service->getPlaceCategories();
    }

    public function testGetPlaceTypesHitsCorrectUrl(): void
    {
        $client  = $this->prophesize(Client::class);
        $service = new TfLPlaceService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $client->get('Meta/PlaceTypes?api_key=api_key')->shouldBeCalled()->willReturn(new Response(body: '{}'));
        $service->getPlaceTypes();
    }

    public function testGetPlacesByTypeWithInvalidTypeThrowsException(): void
    {
        $this->expectException(InvalidPlaceType::class);
        $this->expectExceptionMessage("'blah' is not a valid place type.");

        $client  = $this->prophesize(Client::class);
        $service = new TfLPlaceService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $service->getPlacesByType(['blah', 'bloop']);
    }

    public function testGetPlacesByTypeHitsCorrectUrl(): void
    {
        $client  = $this->prophesize(Client::class);
        $service = new TfLPlaceService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $client->get('Type/BikePoint')->shouldBeCalled()->willReturn(new Response(body: '{}'));
        $service->getPlacesByType(['BikePoint']);
    }

    public function testGetPlacesByTypeActiveOnlyHitsCorrectUrl(): void
    {
        $client  = $this->prophesize(Client::class);
        $service = new TfLPlaceService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $client->get('Type/BikePoint?activeOnly=true')->shouldBeCalled()->willReturn(new Response(body: '{}'));
        $service->getPlacesByType(['BikePoint'], true);
    }

    public function testSearchByNameWithTypesHitsCorrectUrl(): void
    {
        $client  = $this->prophesize(Client::class);
        $service = new TfLPlaceService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $client->get('Search?name=Hyde+Park+Street+%28Bayswater+Road%29&types=TaxiRank%2CCarPark&api_key=api_key')->shouldBeCalled()->willReturn(new Response(body: '{}'));
        $service->searchByName('Hyde Park Street (Bayswater Road)', ['TaxiRank', 'CarPark']);
    }

    public function testSearchByNameHitsCorrectUrl(): void
    {
        $client  = $this->prophesize(Client::class);
        $service = new TfLPlaceService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $client->get('Search?name=Hyde+Park+Street+%28Bayswater+Road%29&api_key=api_key')->shouldBeCalled()->willReturn(new Response(body: '{}'));
        $service->searchByName('Hyde Park Street (Bayswater Road)');
    }

    public function testSearchByNameInvalidTypesThrowsException(): void
    {
        $this->expectException(InvalidPlaceType::class);
        $this->expectExceptionMessage("'blah' is not a valid place type.");

        $client  = $this->prophesize(Client::class);
        $service = new TfLPlaceService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $service->searchByName('Hyde Park Street (Bayswater Road)', ['blah']);
    }

    public function testGetPlacesByGeoThrowsException(): void
    {
        $this->expectException(MethodNotImplemented::class);
        $this->expectExceptionMessage("'PlaceService::getPlacesByGeo' method not implemented.");

        $client  = $this->prophesize(Client::class);
        $service = new TfLPlaceService(
            'api_key',
            $client->reveal(),
            new Validator()
        );

        $service->getPlacesByGeo('123', '123');
    }
}
