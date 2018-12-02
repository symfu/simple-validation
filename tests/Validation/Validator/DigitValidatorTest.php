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
        $result = $validator->validate('dummy', '1');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('dummy', '0');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('dummy', '0123456789');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('dummy', '12345678900');
        $this->assertEquals($result, $valid);

        // invalid
        $result = $validator->validate('dummy', 'abc');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('dummy', '-1');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('dummy', '-12345679');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('dummy', '+12345679');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('dummy', '12345.67890');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('dummy', '1234567890a');
        $this->assertEquals($result, $invalid);
    }
}
