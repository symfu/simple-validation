<?php

namespace Symfu\SimpleValidation\Test\Validator;

use Symfu\SimpleValidation\Test\SimpleValidationTestCase;
use Symfu\SimpleValidation\Validator\EnumValidator;


class EnumValidatorTest extends SimpleValidationTestCase {
    public function testValidate() {
        $valid   = [true, ''];
        $invalid = [false, EnumValidator::message];

        $enumLiteral = 'A|B|c';
        $validator = new EnumValidator();

        // valid
        $result = $validator->validate('A', $enumLiteral);
        $this->assertEquals($result, $valid);

        $result = $validator->validate('B', $enumLiteral);
        $this->assertEquals($result, $valid);

        $result = $validator->validate('c', $enumLiteral);
        $this->assertEquals($result, $valid);

        // invalid
        $result = $validator->validate(' ', $enumLiteral);
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('0', $enumLiteral);
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('a', $enumLiteral);
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('b', $enumLiteral);
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('C', $enumLiteral);
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('D', $enumLiteral);
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('FD', $enumLiteral);
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('*', $enumLiteral);
        $this->assertEquals($result, $invalid);
    }
}
