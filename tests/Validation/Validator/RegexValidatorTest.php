<?php

namespace Symfu\SimpleValidation\Test\Validator;

use Symfu\SimpleValidation\Test\SimpleValidationTestCase;
use Symfu\SimpleValidation\Validator\RegexValidator;


class RegexValidatorTest extends SimpleValidationTestCase {
    public function testValidate() {
        // valid
        $validator = new RegexValidator();

        $valid   = [true, ''];
        $invalid = [false, $validator::message];

        $result = $validator->validate('dummy', '');
        $this->assertEquals($result, $valid);

        $validator = new RegexValidator('/[a-z]+/');
        $result    = $validator->validate('dummy', 'abcdefghijklmnopqrstuvwxyz');
        $this->assertEquals($result, $valid);

        $validator = new RegexValidator('/[0-9]+/');
        $result    = $validator->validate('dummy', '0123456789');
        $this->assertEquals($result, $valid);

        // invalid
        $validator = new RegexValidator('/[a-z]+/');
        $result    = $validator->validate('dummy', '0123456789');
        $this->assertEquals($result, $invalid);

        $validator = new RegexValidator('/[a-z]+/');
        $result    = $validator->validate('dummy', '!@#$');
        $this->assertEquals($result, $invalid);
    }
}
