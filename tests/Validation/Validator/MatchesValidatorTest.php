<?php

namespace Symfu\SimpleValidation\Test\Validator;

use Symfu\SimpleValidation\Test\ValidatorTestCase;
use Symfu\SimpleValidation\Validator\MatchesValidator;


class MatchesValidatorTest extends ValidatorTestCase {
    public function testValidate() {
        $password = uniqid('test_password_', true);

        $formValues = ['password' => $password, 'password_confirm' => $password];

        $validator = new MatchesValidator('password');

        $valid   = [true, ''];
        $invalid = [false, $validator::message];

        // valid
        $result = $validator->validate($formValues['password_confirm'], $formValues);
        $this->assertEquals($result, $valid);

        // invalid
        $formValues['password_confirm'] = uniqid('no-matched-confirm-password_', true);
        $result                         = $validator->validate($formValues['password_confirm'], $formValues);
        $this->assertEquals($result, $invalid);

        try {
            // test 3
            $validator = new MatchesValidator('non-existance-field');

            $formValues['password_confirm'] = uniqid('no-matched-confirm-password_', true);
            $result                         = $validator->validate($formValues['password_confirm'], $formValues);
            $this->assertEquals($result, $valid);
        } catch (\PHPUnit_Framework_Error_Warning $ex) {
            return;
        }

        $this->fail('Test 3 shoud raise an E_USER_WARNING error.');
    }
}
