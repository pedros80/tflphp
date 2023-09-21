<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Exceptions;

use Exception;

final class InvalidPlaceType extends Exception
{
    private function __construct(string $message)
    {
        parent::__construct($message, 400);
    }

    public static function fromString(string $type): InvalidPlaceType
    {
        return new InvalidPlaceType("'{$type}' is not a valid place type.");
    }
}
