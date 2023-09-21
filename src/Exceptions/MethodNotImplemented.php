<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Exceptions;

use Exception;

final class MethodNotImplemented extends Exception
{
    private function __construct(string $message)
    {
        parent::__construct($message, 400);
    }

    public static function fromName(string $name): MethodNotImplemented
    {
        $message = "'{$name}' method not implemented.";

        return new MethodNotImplemented($message);
    }
}
