<?php

namespace Symfu\SimpleValidation\Test\Validator;

use Symfu\SimpleValidation\Test\SimpleValidationTestCase;
use Symfu\SimpleValidation\Validator\IntegerValidator;


class IntegerValidatorTest extends SimpleValidationTestCase {
    public function testValidate() {
        $validator = new IntegerValidator();

        $valid   = [true, ''];
        $invalid = [false, $validator::message];

        // valid
        $result = $validator->validate('dummy', '012346789');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('dummy', '-012346789');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('dummy', '+012346789');
        $this->assertEquals($result, $valid);

        // invalid
        $result = $validator->validate('dummy', '0.123456789');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('dummy', '12345.67890');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('dummy', '1234567890a');
        $this->assertEquals($result, $invalid);
    }
}
