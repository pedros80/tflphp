<?php

declare(strict_types=1);

namespace Pedros80\Build\Factories;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use League\Flysystem\Filesystem;
use League\Flysystem\Local\LocalFilesystemAdapter;
use Pedros80\Build\Actions\Abstractions\FromDataFile;
use Pedros80\Build\Actions\Abstractions\FromService;
use Pedros80\Build\Actions\Contracts\Action;
use Pedros80\Build\Actions\GetStationDataFile;
use Pedros80\Build\CodeGen\FileWriter;
use Pedros80\Build\CodeGen\Printer;
use Pedros80\TfLphp\Factories\ServiceFactory;

final class ActionFactory
{
    private const USER_AGENT = 'TfLphp';
    private const TIMEOUT    = 20;
    private const SRC_DIR    = 'src';

    public function __construct(
        private ?string $apiKey=null
    ) {
    }

    public function makeAction(string $class): Action
    {
        if (in_array(get_parent_class($class), [FromService::class, FromDataFile::class])) {
            return $this->makeGeneratesFile($class);
        }

        return match ($class) {
            GetStationDataFile::class => new GetStationDataFile(
                $this->getClient(GetStationDataFile::BASE_URI),
                $this->getLocalFilesystem(GetStationDataFile::DATA_DIR)
            ),
            default => throw new Exception("Unhandled Action - {$class}"),
        };
    }

    private function makeGeneratesFile(string $class): Action
    {
        return match (get_parent_class($class)) {
            FromService::class => new $class(
                new ServiceFactory(),
                $this->apiKey,
                $this->getFileWriter(self::SRC_DIR)
            ),
            FromDataFile::class => new $class($this->getFileWriter(self::SRC_DIR)),
            default             => throw new Exception("Unhandled Action - {$class}"),
        };
    }

    private function getClient(string $base_uri): Client
    {
        return new Client([
            'base_uri'               => $base_uri,
            RequestOptions::HEADERS  => [
                'User-Agent'    => self::USER_AGENT,
                'Content-Type'  => 'application/json',
                'Cache-Control' => 'no-cache',
            ],
            RequestOptions::TIMEOUT => self::TIMEOUT,
        ]);
    }

    private function getLocalFilesystem(string $root): Filesystem
    {
        return new Filesystem(
            new LocalFilesystemAdapter($root)
        );
    }

    private function getFileWriter(string $root): FileWriter
    {
        return new FileWriter(
            $this->getLocalFilesystem($root),
            new Printer()
        );
    }
}
