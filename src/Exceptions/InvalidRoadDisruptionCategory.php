<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Exceptions;

use Exception;

final class InvalidRoadDisruptionCategory extends Exception
{
    private function __construct(string $message)
    {
        parent::__construct($message, 400);
    }

    public static function fromString(string $code): InvalidRoadDisruptionCategory
    {
        return new InvalidRoadDisruptionCategory("'{$code}' is not a valid road disruption category.");
    }
}
