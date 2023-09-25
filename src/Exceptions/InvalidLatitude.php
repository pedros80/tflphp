<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Exceptions;

;

use Exception;

final class InvalidLatitude extends Exception
{
    private function __construct(string $message)
    {
        parent::__construct($message, 400);
    }

    public static function fromString(string $value): InvalidLatitude
    {
        return new InvalidLatitude("'{$value}' is not a valid latitude. Must be between -90 and 90.");
    }
}
