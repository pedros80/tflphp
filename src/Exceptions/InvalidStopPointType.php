<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Exceptions;

use Exception;

final class InvalidStopPointType extends Exception
{
    private function __construct(string $message)
    {
        parent::__construct($message, 400);
    }

    public static function fromString(string $type): InvalidStopPointType
    {
        return new InvalidStopPointType("'{$type}' is not a valid stop point type.");
    }
}
