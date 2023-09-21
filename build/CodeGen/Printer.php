<?php

declare(strict_types=1);

namespace Pedros80\Build\CodeGen;

use Nette\PhpGenerator\Printer as BasePrinter;

final class Printer extends BasePrinter
{
    public string $indentation = '    ';

    public int $linesBetweenMethods = 1;
}
