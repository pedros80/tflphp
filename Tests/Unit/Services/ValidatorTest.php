<?php

namespace Tests\Unit\Services;

use Pedros80\TfLphp\Exceptions\InvalidLatitude;
use Pedros80\TfLphp\Exceptions\InvalidLongitude;
use Pedros80\TfLphp\Services\Validator;
use PHPUnit\Framework\TestCase;

final class ValidatorTest extends TestCase
{
    private Validator $validator;

    public function setUp(): void
    {
        parent::setUp();

        $this->validator = new Validator();
    }

    public function testIsValidLatLngReturnsTrueOnValid(): void
    {
        $this->assertTrue($this->validator->isValidLatLng('34', '34'));
    }

    public function testIsValidLatLngInvalidLatThrowsException(): void
    {
        $this->expectException(InvalidLatitude::class);
        $this->expectExceptionMessage("'95' is not a valid latitude. Must be between -90 and 90.");

        $this->validator->isValidLatLng('95', '95');
    }

    public function testIsValidLatLngInvalidLngThrowsException(): void
    {
        $this->expectException(InvalidLongitude::class);
        $this->expectExceptionMessage("'-195' is not a valid longitude. Must be between -180 and 180.");

        $this->validator->isValidLatLng('90', '-195');
    }
}
