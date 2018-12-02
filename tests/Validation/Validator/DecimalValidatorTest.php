<?php

namespace Symfu\SimpleValidation\Test\Validator;

use Symfu\SimpleValidation\Test\ValidatorTestCase;
use Symfu\SimpleValidation\Validator\DecimalValidator;


class DecimalValidatorTest extends ValidatorTestCase {
    public function testValidate() {
        $validator = new DecimalValidator();

        $valid   = [true, ''];
        $invalid = [false, $validator::message];

        // tests
        $result = $validator->validate('dummy', '1234567890.1234');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('dummy', '-1234567890.1234');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('dummy', '+1234567890.1234');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('dummy', '1234567890');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('dummy', '1234567890.1234.45');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('dummy', 'a12345-67890.1234');
        $this->assertEquals($result, $invalid);
    }
}
