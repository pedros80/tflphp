<?php

namespace Tests\Unit\Enums;

use Pedros80\TfLphp\Enums\RailLines;
use PHPUnit\Framework\TestCase;

final class RailLinesTest extends TestCase
{
    public function testToModeReturnsString(): void
    {
        $line = RailLines::from('circle');

        $this->assertEquals('circle', $line->value);
        $this->assertEquals('tube', $line->toMode());
    }
}
