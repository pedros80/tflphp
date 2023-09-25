<?php

namespace Tests\Unit\Enums;

use Pedros80\TfLphp\Enums\StopPointInformationCategories;
use PHPUnit\Framework\TestCase;

final class StopPointInformationCategoriesTest extends TestCase
{
    public function testAvailableKeysReturnsArray(): void
    {
        $keys = StopPointInformationCategories::ACCESSIBILITY->availableKeys();

        $this->assertIsArray($keys);
    }
}
