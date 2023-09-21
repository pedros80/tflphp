<?php

declare(strict_types=1);

namespace Pedros80\Build\Actions\Abstractions;

use Pedros80\Build\Actions\Contracts\Action;
use Pedros80\Build\Actions\Traits\GeneratesFile;
use Pedros80\Build\CodeGen\FileWriter;
use Pedros80\TfLphp\Factories\ServiceFactory;
use Pedros80\TfLphp\Services\Service;

abstract class FromService implements Action
{
    use GeneratesFile;

    public function __construct(
        protected ServiceFactory $serviceFactory,
        protected string $apiKey,
        protected FileWriter $fileWriter
    ) {
    }

    protected function getService(string $type): Service
    {
        return $this->serviceFactory->makeService($type, $this->apiKey);
    }
}
