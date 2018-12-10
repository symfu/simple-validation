<?php

namespace Symfu\SimpleValidation\Test\Validator;

use Symfu\SimpleValidation\Test\SimpleValidationTestCase;
use Symfu\SimpleValidation\Validator\Base64Validator;


class Base64ValidatorTest extends SimpleValidationTestCase {
    public function testValidate() {
        $validator = new Base64Validator();

        $valid   = [true, null];
        $invalid = [false, $validator::message];

        // valid
        $result = $validator->validate('ZnVjayBjcGMhIQo=');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('5Zyf5YWx5b+F5LqhCg==');
        $this->assertEquals($result, $valid);

        // invalid
        $result = $validator->validate('!@#');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('$%^&*');
        $this->assertEquals($result, $invalid);
    }
}
