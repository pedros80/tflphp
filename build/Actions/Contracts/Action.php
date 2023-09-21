<?php

declare(strict_types=1);

namespace Pedros80\Build\Actions\Contracts;

interface Action
{
    public function execute(): void;
}
