<?php

namespace Symfu\SimpleValidation\Test\Validator;

use Symfu\SimpleValidation\Test\SimpleValidationTestCase;
use Symfu\SimpleValidation\Validator\EqualsToValidator;


class EqualsToValidatorTest extends SimpleValidationTestCase {
    public function testValidate() {
        $password = uniqid('test_password_', true);
        $formValues = ['password' => $password, 'password_confirm' => $password];

        $validator = new EqualsToValidator();

        $valid   = [true, ''];
        $invalid = [false, $validator::message];

        // valid
        // equals[password]
        $result = $validator->validate($formValues['password_confirm'], 'password', 'password_confirm', $formValues);
        $this->assertEquals($result, $valid);

        // invalid
        $formValues['password_confirm'] = uniqid('no-matched-confirm-password_', true);
        $result                         = $validator->validate($formValues['password_confirm'], 'password', 'password_confirm', $formValues);
        $this->assertEquals($result, $invalid);

        try {
            // test 3
            $formValues['password_confirm'] = uniqid('no-matched-confirm-password_', true);
            $result                         = $validator->validate($formValues['password_confirm'], 'non-existance-field', 'password_confirm', $formValues);

            $this->fail("We should never reach here！");
        } catch (\InvalidArgumentException $e) {
            $this->assertTrue(true, 'We should catch InvalidArugmentException here');
        }
    }
}
