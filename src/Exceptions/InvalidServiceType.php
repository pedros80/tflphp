<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Exceptions;

use Exception;

final class InvalidServiceType extends Exception
{
    private function __construct(string $message)
    {
        parent::__construct($message, 400);
    }

    public static function fromString(string $type): InvalidServiceType
    {
        return new InvalidServiceType("'{$type} is not a valid service type.");
    }
}
