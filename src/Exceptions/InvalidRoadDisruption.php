<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Exceptions;

use Exception;

final class InvalidRoadDisruption extends Exception
{
    private function __construct(string $message)
    {
        parent::__construct($message, 400);
    }

    public static function fromString(string $code): InvalidRoadDisruption
    {
        return new InvalidRoadDisruption("'{$code}' is not a valid road disruption code.");
    }
}
