<?php

namespace Symfu\SimpleValidation\Test\Validator;

use Symfu\SimpleValidation\Test\ValidatorTestCase;
use Symfu\SimpleValidation\Validator\AlphaValidator;


class AlphaValidatorTest extends ValidatorTestCase {
    public function testValidate() {
        $validator = new AlphaValidator();

        $valid   = [true, ''];
        $invalid = [false, $validator::message];

        // tests
        $result = $validator->validate('dummy', 'abcdefhijklmnopqrstuvwxyz');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('dummy', 'abcdefhijklmnopqrstuvwxyz0123456789');
        $this->assertEquals($result, $invalid);
    }
}
