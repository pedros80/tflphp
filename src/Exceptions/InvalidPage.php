<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Exceptions;

use Exception;

final class InvalidPage extends Exception
{
    private function __construct(string $message)
    {
        parent::__construct($message, 400);
    }

    public static function fromInt(int $page): InvalidPage
    {
        return new InvalidPage("'{$page}' is not a valid page number.");
    }
}
