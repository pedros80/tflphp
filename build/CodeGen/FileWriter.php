<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Build\CodeGen;

use League\Flysystem\Filesystem;
use League\Flysystem\FilesystemException;
use League\Flysystem\UnableToWriteFile;
use Nette\PhpGenerator\PhpFile;

final class FileWriter
{
    public function __construct(
        private Filesystem $fileSystem,
        private Printer $printer
    ) {
    }

    public function write(string $path, PhpFile $file): bool
    {
        try {
            $this->fileSystem->write($path, $this->printer->printFile($file));
        } catch (FilesystemException | UnableToWriteFile) {
            return false;
        }

        return true;
    }
}
