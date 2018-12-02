<?php

namespace Symfu\SimpleValidation\Test\Validator;

use Symfu\SimpleValidation\Test\ValidatorTestCase;
use Symfu\SimpleValidation\Validator\DateValidator;


class DateValidatorTest extends ValidatorTestCase {
    public function testValidate() {
        $validator = new DateValidator();

        $valid   = [true, ''];
        $invalid = [false, $validator::message];

        // invaid tests
        $result = $validator->validate('dummy', '2012-12-12');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('dummy', '2012/12/12');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('dummy', '2012.12.12');
        $this->assertEquals($result, $valid);

        // ininvaid tests
        $result = $validator->validate('dummy', '2012-12-aa');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('dummy', '2012/!2/12');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('dummy', '201o.12.12');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('dummy', './*+~!@#$%^&*abcdefhijklmno_01234-pqrstuvwxyz_56789');
        $this->assertEquals($result, $invalid);
    }
}
