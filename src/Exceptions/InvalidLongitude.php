<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Exceptions;

use Exception;

final class InvalidLongitude extends Exception
{
    private function __construct(string $message)
    {
        parent::__construct($message, 400);
    }

    public static function fromString(string $value): InvalidLongitude
    {
        return new InvalidLongitude("{$value} is not a valid longitude. Must be between -180 and 180");
    }
}
