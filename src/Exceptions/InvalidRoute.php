<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Exceptions;

use Exception;

final class InvalidRoute extends Exception
{
    private function __construct(string $message)
    {
        parent::__construct($message, 400);
    }

    public static function fromString(string $line): InvalidRoute
    {
        return new InvalidRoute("'{$line}' is not a valid route.");
    }
}
