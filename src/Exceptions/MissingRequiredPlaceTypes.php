<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Exceptions;

use Exception;

final class MissingRequiredPlaceTypes extends Exception
{
    private function __construct(string $message)
    {
        parent::__construct($message, 400);
    }

    public static function new(): MissingRequiredPlaceTypes
    {
        return new MissingRequiredPlaceTypes('StopType missing from request.');
    }
}
