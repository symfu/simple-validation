<?php

namespace Symfu\SimpleValidation\Test\Validator;

use Symfu\SimpleValidation\Test\SimpleValidationTestCase;
use Symfu\SimpleValidation\Validator\ExactLengthValidator;


class ExactLengthValidatorTest extends SimpleValidationTestCase {
    public function testValidate() {
        $validator = new ExactLengthValidator('9');

        $valid   = [true, ''];
        $invalid = [false, $validator::message];

        // valid
        $result = $validator->validate('dummy', '123456789');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('dummy', 'abcdefghi');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('dummy', '不多不少正好九个字');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('dummy', '中英混合words');
        $this->assertEquals($result, $valid);

        // invalid
        $result = $validator->validate('dummy', '12345678');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('dummy', '123456789_');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('dummy', '不到九个字.');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('dummy', '这肯定超过九个字了吧？？');
        $this->assertEquals($result, $invalid);
    }
}
