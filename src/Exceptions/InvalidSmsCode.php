<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Exceptions;

use Exception;

final class InvalidSmsCode extends Exception
{
    private function __construct(string $message)
    {
        parent::__construct($message, 400);
    }

    public static function fromString(string $code): InvalidSmsCode
    {
        return new InvalidSmsCode("'{$code} is not a valid sms code.");
    }
}
