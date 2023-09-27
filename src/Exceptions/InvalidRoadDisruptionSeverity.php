<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Exceptions;

use Exception;

final class InvalidRoadDisruptionSeverity extends Exception
{
    private function __construct(string $message)
    {
        parent::__construct($message, 400);
    }

    public static function fromInt(int $severity): InvalidRoadDisruptionSeverity
    {
        return new InvalidRoadDisruptionSeverity("'{$severity}' is not a valid road severity code.");
    }
}
