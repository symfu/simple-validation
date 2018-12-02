<?php

namespace Symfu\SimpleValidation\Test\Validator;

use Symfu\SimpleValidation\Test\SimpleValidationTestCase;
use Symfu\SimpleValidation\Validator\MaxValidator;


class MaxValidatorTest extends SimpleValidationTestCase {
    public function testValidate() {
        // valid
        $validator = new MaxValidator('99');

        $valid   = [true, ''];
        $invalid = [false, $validator::message];

        $result = $validator->validate('dummy', '98');
        $this->assertEquals($result, $valid);

        $validator = new MaxValidator('100');
        $result    = $validator->validate('dummy', '99');
        $this->assertEquals($result, $valid);

        // invalid
        $validator = new MaxValidator('15');
        $result    = $validator->validate('dummy', '20');
        $this->assertEquals($result, $invalid);
    }
}
