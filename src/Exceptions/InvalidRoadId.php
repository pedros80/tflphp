<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Exceptions;

use Exception;

final class InvalidRoadId extends Exception
{
    private function __construct(string $message)
    {
        parent::__construct($message, 400);
    }

    public static function fromString(string $id): InvalidRoadId
    {
        return new InvalidRoadId("'{$id}' is not a valid road id.");
    }
}
