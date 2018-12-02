<?php

namespace Symfu\SimpleValidation\Test\Validator;

use Symfu\SimpleValidation\Test\ValidatorTestCase;
use Symfu\SimpleValidation\Validator\EmailValidator;


class EmailValidatorTest extends ValidatorTestCase {
    public function testValidate() {
        $validator = new EmailValidator();

        $valid   = [true, ''];
        $invalid = [false, $validator::message];

        // valid
        $result = $validator->validate('dummy', 'test@example.com');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('dummy', 'test_123@example.com');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('dummy', 'test-123@example.com');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('dummy', 'test-123@subdomain.subdomain.example.com');
        $this->assertEquals($result, $valid);

        // invalid
        $result = $validator->validate('dummy', 'test!@example.com');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('dummy', 'test@ex!ample.com');
        $this->assertEquals($result, $invalid);
    }
}
