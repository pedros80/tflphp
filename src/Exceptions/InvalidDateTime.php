<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Exceptions;

use Exception;

final class InvalidDateTime extends Exception
{
    private function __construct(string $message)
    {
        parent::__construct($message, 400);
    }

    public static function fromString(string $dateTime): InvalidDateTime
    {
        return new InvalidDateTime("'{$dateTime} is not a valid RFC3339 date time.");
    }
}
