<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Services;

use Pedros80\TfLphp\Contracts\BikePointService;
use Pedros80\TfLphp\Services\Service;

final class TfLBikePointService extends Service implements BikePointService
{
    public function getAll(): array
    {
        return $this->get(
            auth: false
        );
    }

    public function getById(string $id): array
    {
        $this->validator->isValidBikePointId($id);

        $this->url[] = $id;

        return $this->get();
    }

    public function search(string $term): array
    {
        $this->url[] = 'Search';

        $this->params['query'] = $term;

        return $this->get();
    }
}
