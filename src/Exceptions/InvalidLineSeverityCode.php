<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Exceptions;

use Exception;

final class InvalidLineSeverityCode extends Exception
{
    private function __construct(string $message)
    {
        parent::__construct($message, 400);
    }

    public static function fromInt(int $severity): InvalidLineSeverityCode
    {
        return new InvalidLineSeverityCode("'{$severity} is not a valid line severity code.");
    }
}
