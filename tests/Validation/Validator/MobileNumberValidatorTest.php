<?php

namespace Symfu\SimpleValidation\Test\Validator;

use Symfu\SimpleValidation\Test\SimpleValidationTestCase;
use Symfu\SimpleValidation\Validator\MobileNumberValidator;
use Symfu\SimpleValidation\Validator\NaturalValidator;


class MobileNumberValidatorTest extends SimpleValidationTestCase {
    public function testValidate() {
        $validator = new MobileNumberValidator();

        $valid   = [true, ''];
        $invalid = [false, $validator::message];

        // valid
        $result = $validator->validate('13978988413');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('15070923728');
        $this->assertEquals($result, $valid);

        // invalid
        $result = $validator->validate('0');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('-1');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('12345679');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('188123456789');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('1881234567');
        $this->assertEquals($result, $invalid);
    }
}
