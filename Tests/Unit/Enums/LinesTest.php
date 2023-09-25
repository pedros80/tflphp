<?php

namespace Tests\Unit\Enums;

use Pedros80\TfLphp\Enums\Lines;
use PHPUnit\Framework\TestCase;

final class LinesTest extends TestCase
{
    public function testToModeReturnsString(): void
    {
        $line = Lines::from('circle');

        $this->assertEquals('circle', $line->value);
        $this->assertEquals('tube', $line->toMode());
    }
}
