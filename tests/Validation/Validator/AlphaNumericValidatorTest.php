<?php
namespace Symfu\SimpleValidation\Test\Validator;

use Symfu\SimpleValidation\Test\SimpleValidationTestCase;
use Symfu\SimpleValidation\Validator\AlphaNumValidator;

class AlphaNumericValidatorTest extends SimpleValidationTestCase
{
    public function testValidate()
    {
        $validator = new AlphaNumValidator();

        $valid = [true, ''];
        $invalid = [false, $validator::message];

        // tests
        $result = $validator->validate('dummy', 'abcdefhijklmno01234pqrstuvwxyz56789');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('dummy', '_abcdefhijklmno01234pqrstuvwxyz56789');
        $this->assertEquals($result, $invalid);
    }
}
