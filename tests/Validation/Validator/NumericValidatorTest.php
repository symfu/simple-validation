<?php

namespace Symfu\SimpleValidation\Test\Validator;

use Symfu\SimpleValidation\Test\ValidatorTestCase;
use Symfu\SimpleValidation\Validator\NumericValidator;


class NumericValidatorTest extends ValidatorTestCase {
    public function testValidate() {
        $validator = new NumericValidator();

        $valid   = [true, ''];
        $invalid = [false, $validator::message];

        // valid
        $result = $validator->validate('dummy', '');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('dummy', '0');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('dummy', '1');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('dummy', '123456789');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('dummy', '-123456789');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('dummy', '+123456789');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('dummy', '123456789.123456');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('dummy', '5.556E+9');
        $this->assertEquals($result, $valid);

        // invalid
        $result = $validator->validate('dummy', '--12345679');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('dummy', '++12345679');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('dummy', 'a12345.67890');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('dummy', '1234567890a');
        $this->assertEquals($result, $invalid);
    }
}
