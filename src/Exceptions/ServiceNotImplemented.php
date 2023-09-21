<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Exceptions;

use Exception;

final class ServiceNotImplemented extends Exception
{
    private function __construct(string $message)
    {
        parent::__construct($message, 400);
    }

    public static function fromType(string $type): ServiceNotImplemented
    {
        $message = "'{$type}' service not implemented.";

        return new ServiceNotImplemented($message);
    }
}
