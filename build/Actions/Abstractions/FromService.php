<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Build\Actions\Abstractions;

use Pedros80\TfLphp\Build\Actions\Contracts\Action;
use Pedros80\TfLphp\Build\Actions\Traits\GeneratesFile;
use Pedros80\TfLphp\Build\CodeGen\FileWriter;
use Pedros80\TfLphp\Contracts\JourneyService;
use Pedros80\TfLphp\Contracts\LineService;
use Pedros80\TfLphp\Contracts\PlaceService;
use Pedros80\TfLphp\Contracts\RoadService;
use Pedros80\TfLphp\Contracts\StopPointService;
use Pedros80\TfLphp\Factories\ServiceFactory;
use Pedros80\TfLphp\Services\Service;
use RuntimeException;

abstract class FromService implements Action
{
    use GeneratesFile;

    public function __construct(
        protected ServiceFactory $serviceFactory,
        protected string $apiKey,
        protected FileWriter $fileWriter,
    ) {
    }

    protected function getJourneyService(): JourneyService
    {
        $service = $this->getService(ServiceFactory::JOURNEY);

        if (!$service instanceof JourneyService) {
            throw new RuntimeException('Expected JourneyService.');
        }

        return $service;
    }

    protected function getLineService(): LineService
    {
        $service = $this->getService(ServiceFactory::LINE);

        if (!$service instanceof LineService) {
            throw new RuntimeException('Expected LineService.');
        }

        return $service;
    }

    protected function getStopPointService(): StopPointService
    {
        $service = $this->getService(ServiceFactory::STOP_POINT);

        if (!$service instanceof StopPointService) {
            throw new RuntimeException('Expected StopPointService.');
        }

        return $service;
    }

    protected function getPlaceService(): PlaceService
    {
        $service = $this->getService(ServiceFactory::STOP_POINT);

        if (!$service instanceof PlaceService) {
            throw new RuntimeException('Expected PlaceService.');
        }

        return $service;
    }

    protected function getRoadService(): RoadService
    {
        $service = $this->getService(ServiceFactory::STOP_POINT);

        if (!$service instanceof RoadService) {
            throw new RuntimeException('Expected RoadService.');
        }

        return $service;
    }

    private function getService(string $type): Service
    {
        return $this->serviceFactory->makeService($type, $this->apiKey);
    }
}
