<?php
namespace Symfu\SimpleValidation\Test\Validator;

use Symfu\SimpleValidation\Test\SimpleValidationTestCase;
use Symfu\SimpleValidation\Validator\AlphaDashValidator;

class AlphaDashValidatorTest extends SimpleValidationTestCase
{
    public function testValidate()
    {
        $validator = new AlphaDashValidator();

        $valid = [true, null];
        $invalid = [false, $validator::message];

        // valid
        $result = $validator->validate('_abcdefhijklmno_01234-pqrstuvwxyz_56789');
        $this->assertEquals($result, $valid);

        // invalid
        $result = $validator->validate('.abcde');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('abc de');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('./*+~!@#$%^&*abcdefhijklmno_01234-pqrstuvwxyz_56789');
        $this->assertEquals($result, $invalid);
    }
}
