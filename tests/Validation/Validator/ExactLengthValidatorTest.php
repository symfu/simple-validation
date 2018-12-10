<?php

namespace Symfu\SimpleValidation\Test\Validator;

use Symfu\SimpleValidation\Test\SimpleValidationTestCase;
use Symfu\SimpleValidation\Validator\ExactLengthValidator;


class ExactLengthValidatorTest extends SimpleValidationTestCase {
    public function testValidate() {
        $validator = new ExactLengthValidator();

        $valid   = [true, null];
        $invalid = [false, $validator::message];

        // valid
        $result = $validator->validate('', '9');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('123456789', '9');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('abcdefghi', '9');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('不多不少正好九个字', '9');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('中英混合words', '9');
        $this->assertEquals($result, $valid);

        // invalid
        $result = $validator->validate('12345678', '9');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('123456789_', '9');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('不到九个字.', '9');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('这肯定超过九个字了吧？？', '9');
        $this->assertEquals($result, $invalid);
    }
}
