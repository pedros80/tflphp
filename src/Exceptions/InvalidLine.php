<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Exceptions;

use Exception;

final class InvalidLine extends Exception
{
    private function __construct(string $message)
    {
        parent::__construct($message, 400);
    }

    public static function fromString(string $line): InvalidLine
    {
        return new InvalidLine("'{$line}' is not a valid line.");
    }
}
