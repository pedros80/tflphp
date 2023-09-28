<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Build\Actions\Abstractions;

use Exception;
use Pedros80\TfLphp\Build\Actions\Contracts\Action;
use Pedros80\TfLphp\Build\Actions\Traits\GeneratesFile;
use Pedros80\TfLphp\Build\CodeGen\FileWriter;
use ZipArchive;

use function Safe\getcwd;

abstract class FromDataFile implements Action
{
    use GeneratesFile;

    public function __construct(
        protected FileWriter $fileWriter
    ) {
    }

    public const ZIP = 'data/tfl-stationdata-detailed';

    protected function getCsv(string $fileName): array
    {
        $zip     = new ZipArchive();
        $success = $zip->open($this->getZipFilePath(), ZipArchive::RDONLY);
        if ($success) {
            $file = $zip->getFromName("{$fileName}.csv");
            if ($file) {
                return $this->convertToCsv($file);
            }
        }

        throw new Exception("Couldn't open zip");
    }

    private function convertToCsv(string $data): array
    {
        return array_map(
            fn (string $row) => str_getcsv($row),
            explode(PHP_EOL, trim($data))
        );
    }

    private function getZipFilePath(): string
    {
        return sprintf('%s/%s.zip', getcwd(), self::ZIP);
    }
}
