<?php

namespace Symfu\SimpleValidation\Test\Validator;

use Symfu\SimpleValidation\Test\SimpleValidationTestCase;
use Symfu\SimpleValidation\Validator\RegexValidator;


class RegexValidatorTest extends SimpleValidationTestCase {
    public function testValidate() {
        $valid   = [true, ''];
        $invalid = [false, RegexValidator::message];

        $validator = new RegexValidator();
        $result    = $validator->validate('abcdefghijklmnopqrstuvwxyz', '/[a-z]+/');
        $this->assertEquals($result, $valid);

        $validator = new RegexValidator();
        $result    = $validator->validate('0123456789', '/[0-9]+/');
        $this->assertEquals($result, $valid);

        // invalid
        $validator = new RegexValidator();
        $result    = $validator->validate('0123456789', '/[a-z]+/');
        $this->assertEquals($result, $invalid);

        $validator = new RegexValidator();
        $result    = $validator->validate('!@#$', '/[a-z]+/');
        $this->assertEquals($result, $invalid);
    }
}
