<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Exceptions;

use Exception;

final class InvalidStopPointMode extends Exception
{
    private function __construct(string $message)
    {
        parent::__construct($message, 400);
    }

    public static function fromString(string $mode): InvalidStopPointMode
    {
        return new InvalidStopPointMode("'{$mode}' is not a valid stop point mode.");
    }
}
