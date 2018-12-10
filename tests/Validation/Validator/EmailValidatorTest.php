<?php

namespace Symfu\SimpleValidation\Test\Validator;

use Symfu\SimpleValidation\Test\SimpleValidationTestCase;
use Symfu\SimpleValidation\Validator\EmailValidator;


class EmailValidatorTest extends SimpleValidationTestCase {
    public function testValidate() {
        $validator = new EmailValidator();

        $valid   = [true, null];
        $invalid = [false, $validator::message];

        // valid
        $result = $validator->validate('test@example.com');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('test_123@example.com');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('test-123@example.com');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('test-123@subdomain.subdomain.example.com');
        $this->assertEquals($result, $valid);

        // invalid
        $result = $validator->validate('test!@example.com');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('test@ex!ample.com');
        $this->assertEquals($result, $invalid);
    }
}
