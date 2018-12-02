<?php
namespace Symfu\SimpleValidation\Test\Validator;

use Symfu\SimpleValidation\Test\ValidatorTestCase;
use Symfu\SimpleValidation\Validator\AlphaNumericValidator;

class AlphaNumericValidatorTest extends ValidatorTestCase
{
    public function testValidate()
    {
        $validator = new AlphaNumericValidator();

        $valid = [true, ''];
        $invalid = [false, $validator::message];

        // tests
        $result = $validator->validate('dummy', 'abcdefhijklmno01234pqrstuvwxyz56789');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('dummy', '_abcdefhijklmno01234pqrstuvwxyz56789');
        $this->assertEquals($result, $invalid);
    }
}
