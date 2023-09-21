<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Exceptions;

use Exception;

final class InvalidCarParkId extends Exception
{
    private function __construct(string $message)
    {
        parent::__construct($message, 400);
    }

    public static function fromString(string $id): InvalidCarParkId
    {
        return new InvalidCarParkId("'{$id} is not a valid car park id.");
    }
}
