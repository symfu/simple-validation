<?php

namespace Symfu\SimpleValidation\Test\Validator;

use Symfu\SimpleValidation\Test\ValidatorTestCase;
use Symfu\SimpleValidation\Validator\Base64Validator;


class Base64ValidatorTest extends ValidatorTestCase {
    public function testValidate() {
        $validator = new Base64Validator();

        $valid   = [true, ''];
        $invalid = [false, $validator::message];

        // valid
        $result = $validator->validate('dummy', 'ZnVjayBjcGMhIQo=');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('dummy', '5Zyf5YWx5b+F5LqhCg==');
        $this->assertEquals($result, $valid);

        // invalid
        $result = $validator->validate('dummy', '!@#');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('dummy', '$%^&*');
        $this->assertEquals($result, $invalid);
    }
}
