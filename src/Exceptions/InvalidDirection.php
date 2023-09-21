<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Exceptions;

use Exception;

final class InvalidDirection extends Exception
{
    private function __construct(string $message)
    {
        parent::__construct($message, 400);
    }

    public static function fromString(string $direction): InvalidDirection
    {
        return new InvalidDirection("'{$direction} is not a valid direction.");
    }
}
