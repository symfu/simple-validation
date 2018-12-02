<?php

namespace Symfu\SimpleValidation\Test\Validator;

use Symfu\SimpleValidation\Test\SimpleValidationTestCase;
use Symfu\SimpleValidation\Validator\EnumValidator;


class EnumValidatorTest extends SimpleValidationTestCase {
    public function testValidate() {
        $valid   = [true, ''];
        $invalid = [false, EnumValidator::message];


        $validator = new EnumValidator('A|B|c');

        // valid
        $result = $validator->validate('dummy', 'A');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('dummy', 'B');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('dummy', 'c');
        $this->assertEquals($result, $valid);

        // invalid
        $result = $validator->validate('dummy', ' ');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('dummy', '0');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('dummy', 'a');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('dummy', 'b');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('dummy', 'C');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('dummy', 'D');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('dummy', 'FD');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('dummy', '*');
        $this->assertEquals($result, $invalid);
    }
}
