<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Exceptions;

use Exception;

final class InvalidLineMode extends Exception
{
    private function __construct(string $message)
    {
        parent::__construct($message, 400);
    }

    public static function fromString(string $mode): InvalidLineMode
    {
        return new InvalidLineMode("'{$mode}' is not a valid line mode.");
    }
}
