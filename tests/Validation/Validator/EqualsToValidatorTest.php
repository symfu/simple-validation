<?php

namespace Symfu\SimpleValidation\Test\Validator;

use Symfu\SimpleValidation\Test\SimpleValidationTestCase;
use Symfu\SimpleValidation\Validator\EqualsToValidator;


class EqualsToValidatorTest extends SimpleValidationTestCase {
    public function testValidate() {
        $password = uniqid('test_password_', true);

        $formValues = ['password' => $password, 'password_confirm' => $password];

        $validator = new EqualsToValidator('password');

        $valid   = [true, ''];
        $invalid = [false, $validator::message];

        // valid
        $result = $validator->validate('password', $formValues['password_confirm'], $formValues);
        $this->assertEquals($result, $valid);

        // invalid
        $formValues['password_confirm'] = uniqid('no-matched-confirm-password_', true);
        $result                         = $validator->validate('password', $formValues['password_confirm'], $formValues);
        $this->assertEquals($result, $invalid);

            // test 3
        $validator = new EqualsToValidator('non-existance-field');

        $formValues['password_confirm'] = uniqid('no-matched-confirm-password_', true);
        $result                         = $validator->validate('password', $formValues['password_confirm'], $formValues);
        $this->assertEquals($result, $invalid);
    }
}
