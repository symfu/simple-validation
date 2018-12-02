<?php

namespace Symfu\SimpleValidation\Test\Validator;

use Symfu\SimpleValidation\Test\SimpleValidationTestCase;
use Symfu\SimpleValidation\Validator\DecimalValidator;


class DecimalValidatorTest extends SimpleValidationTestCase {
    public function testValidate() {
        $validator = new DecimalValidator();

        $valid   = [true, ''];
        $invalid = [false, $validator::message];

        // valid
        $result = $validator->validate('dummy', '1234567890.1234');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('dummy', '-1234567890.1234');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('dummy', '+1234567890.1234');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('dummy', '1234567890');
        $this->assertEquals($result, $valid);

        // invalid
        $result = $validator->validate('dummy', '1234567890.1234.45');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('dummy', 'a1234567890.1234');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('dummy', '1234567890.1234a');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('dummy', '123456-7890.1234');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('dummy', '1234_567890.1234');
        $this->assertEquals($result, $invalid);
    }
}
