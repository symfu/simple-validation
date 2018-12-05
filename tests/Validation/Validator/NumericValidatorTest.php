<?php

namespace Symfu\SimpleValidation\Test\Validator;

use Symfu\SimpleValidation\Test\SimpleValidationTestCase;
use Symfu\SimpleValidation\Validator\NumericValidator;


class NumericValidatorTest extends SimpleValidationTestCase {
    public function testValidate() {
        $validator = new NumericValidator();

        $valid   = [true, ''];
        $invalid = [false, $validator::message];

        // valid
        $result = $validator->validate('');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('0');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('1');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('123456789');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('-123456789');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('+123456789');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('123456789.123456');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('5.556E+9');
        $this->assertEquals($result, $valid);

        // invalid
        $result = $validator->validate('--12345679');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('++12345679');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('a12345.67890');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('1234567890a');
        $this->assertEquals($result, $invalid);
    }
}
