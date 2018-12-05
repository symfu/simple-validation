<?php
namespace Symfu\SimpleValidation\Test\Validator;

use Symfu\SimpleValidation\Test\SimpleValidationTestCase;
use Symfu\SimpleValidation\Validator\DigitValidator;
use Symfu\SimpleValidation\Validator\NaturalValidator;


class DigitValidatorTest extends SimpleValidationTestCase
{
    public function testValidate()
    {
        $validator = new DigitValidator();

        $valid   = [true, ''];
        $invalid = [false, $validator::message];

        // valid
        $result = $validator->validate('1');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('0');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('0123456789');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('12345678900');
        $this->assertEquals($result, $valid);

        // invalid
        $result = $validator->validate('abc');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('-1');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('-12345679');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('+12345679');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('12345.67890');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('1234567890a');
        $this->assertEquals($result, $invalid);
    }
}
