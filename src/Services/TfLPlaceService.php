<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Services;

use Pedros80\TfLphp\Contracts\PlaceService;
use Pedros80\TfLphp\Exceptions\MethodNotImplemented;
use Pedros80\TfLphp\Services\Service;

final class TfLPlaceService extends Service implements PlaceService
{
    public function getPlaceCategories(): array
    {
        $this->url[] = 'Meta';
        $this->url[] = 'Categories';

        return $this->get();
    }

    public function getPlaceTypes(): array
    {
        $this->url[] = 'Meta';
        $this->url[] = 'PlaceTypes';

        return $this->get();
    }

    public function getPlacesByType(array $types, bool $activeOnly=false): array
    {
        $this->validator->isValidPlaceType($types);

        $this->url[] = 'Type';
        $this->url[] = $types;

        if ($activeOnly) {
            $this->params['activeOnly'] = 'true';
        }

        return $this->get(
            auth: false
        );
    }

    public function searchByName(string $name, array $types=[]): array
    {
        $this->url[] = 'Search';

        $this->params['name'] = $name;
        if ($types) {
            $this->validator->isValidPlaceType($types);
            $this->params['types'] = $types;
        }

        return $this->get();
    }

    public function getPlacesByTypeAndLatLng(array $types, string $lat, string $lng): array
    {
        $this->validator->isValidPlaceType($types);
        $this->validator->isValidLatLng($lat, $lng);

        $this->url[] = $types;
        $this->url[] = 'At';
        $this->url[] = $lat;
        $this->url[] = $lng;

        return $this->get();
    }

    public function getPlaceById(string $id, bool $includeChildren = false): array
    {
        $this->url[] = $id;

        if ($includeChildren) {
            $this->params['includeChildren'] = 'true';
        }

        return $this->get();
    }

    public function getPlacesByGeo(string $lat, string $lng, ?string $radius = null, array $categories = [], bool $includeChildren = false, array $types = [], bool $activeOnly = false, ?int $numberOfPlacesToReturn = null): array
    {
        throw MethodNotImplemented::fromName('PlaceService::getPlacesByGeo');
    }
}
