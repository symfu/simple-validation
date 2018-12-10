<?php

namespace Symfu\SimpleValidation\Test\Validator;

use Symfu\SimpleValidation\Test\SimpleValidationTestCase;
use Symfu\SimpleValidation\Validator\IdCardValidator;


class IdCardValidatorTest extends SimpleValidationTestCase {
    public function testValidate() {
        $validator = new IdCardValidator();

        $valid   = [true, null];
        $invalid = [false, $validator::message];

        // valid
        $result = $validator->validate('450107199410224678');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('450126197003144566');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('450126197403282132');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('450105197212028041');
        $this->assertEquals($result, $valid);

        // invalid
        $result = $validator->validate('450105197212028040');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('0');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('12456789');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('45010519721202804121212');
        $this->assertEquals($result, $invalid);
    }
}
