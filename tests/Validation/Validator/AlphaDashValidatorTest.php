<?php
namespace Symfu\SimpleValidation\Test\Validator;

use Symfu\SimpleValidation\Test\SimpleValidationTestCase;
use Symfu\SimpleValidation\Validator\AlphaDashValidator;

class AlphaDashValidatorTest extends SimpleValidationTestCase
{
    public function testValidate()
    {
        $validator = new AlphaDashValidator();

        $valid = [true, ''];
        $invalid = [false, $validator::message];

        // valid
        $result = $validator->validate('dummy', '_abcdefhijklmno_01234-pqrstuvwxyz_56789');
        $this->assertEquals($result, $valid);

        // invalid
        $result = $validator->validate('dummy', '.abcde');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('dummy', 'abc de');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('dummy', './*+~!@#$%^&*abcdefhijklmno_01234-pqrstuvwxyz_56789');
        $this->assertEquals($result, $invalid);
    }
}
