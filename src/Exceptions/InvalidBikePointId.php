<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Exceptions;

use Exception;

final class InvalidBikePointId extends Exception
{
    private function __construct(string $message)
    {
        parent::__construct($message, 400);
    }

    public static function fromString(string $id): InvalidBikePointId
    {
        return new InvalidBikePointId("'{$id}' is not a valid bike point id.");
    }
}
