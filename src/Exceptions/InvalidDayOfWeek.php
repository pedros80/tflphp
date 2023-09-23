<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Exceptions;

use Exception;

final class InvalidDayOfWeek extends Exception
{
    private function __construct(string $message)
    {
        parent::__construct($message, 400);
    }

    public static function fromString(string $day): InvalidDayOfWeek
    {
        return new InvalidDayOfWeek("'{$day}' is not a valid day of the week.");
    }
}
