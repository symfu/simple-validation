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
        $result = $validator->validate('0');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('1');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('str');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('!@#$%');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('+123456789');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('123456789.123456');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('5.556E+9');
        $this->assertEquals($result, $valid);

        // invalid
        $result = $validator->validate('');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate(null);
        $this->assertEquals($result, $invalid);

        $result = $validator->validate(false);
        $this->assertEquals($result, $invalid);
    }
}
