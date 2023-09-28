<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Build\Actions;

use GuzzleHttp\Client;
use League\Flysystem\Filesystem;
use Pedros80\TfLphp\Build\Actions\Contracts\Action;

final class GetStationDataFile implements Action
{
    public const BASE_URI   = 'https://api.tfl.gov.uk/stationdata/';
    public const DATA_DIR   = 'data';
    public const FILE       = 'tfl-stationdata-detailed.zip';

    public function __construct(
        private Client $client,
        private Filesystem $filesystem
    ) {
    }

    public function execute(): void
    {
        $response = $this->client->get(self::FILE);
        $file     = $response->getBody();

        $this->filesystem->write(self::FILE, (string) $file);
    }
}
