<?php

namespace Symfu\SimpleValidation\Test\Validator;

use Symfu\SimpleValidation\Test\SimpleValidationTestCase;
use Symfu\SimpleValidation\Validator\RequiredValidator;


class RequiredValidatorTest extends SimpleValidationTestCase {
    public function testValidate() {
        $validator = new RequiredValidator();

        $valid   = [true, ''];
        $invalid = [false, $validator::message];

        // valid
        $result = $validator->validate('dummy', '0');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('dummy', '1');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('dummy', 'str');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('dummy', '!@#$%');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('dummy', '+123456789');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('dummy', '123456789.123456');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('dummy', '5.556E+9');
        $this->assertEquals($result, $valid);

        // invalid
        $result = $validator->validate('dummy', '');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('dummy', null);
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('dummy', false);
        $this->assertEquals($result, $invalid);
    }
}