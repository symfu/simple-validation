<?php

namespace Symfu\SimpleValidation\Test\Validator;

use Symfu\SimpleValidation\Test\SimpleValidationTestCase;
use Symfu\SimpleValidation\Validator\MinValidator;


class GreaterThanValidatorTest extends SimpleValidationTestCase {
    public function testValidate() {
        // valid
        $validator = new MinValidator('98');

        $valid   = [true, ''];
        $invalid = [false, $validator::message];

        $result = $validator->validate('dummy', '99');
        $this->assertEquals($result, $valid);
        $validator = new MinValidator('99');
        $result    = $validator->validate('dummy', '100');
        $this->assertEquals($result, $valid);

        // invalid
        $validator = new MinValidator('20');
        $result    = $validator->validate('dummy', '15');
        $this->assertEquals($result, $invalid);
    }
}
