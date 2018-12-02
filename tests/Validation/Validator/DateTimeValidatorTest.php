<?php

namespace Symfu\SimpleValidation\Test\Validator;

use Symfu\SimpleValidation\Test\SimpleValidationTestCase;
use Symfu\SimpleValidation\Validator\DateTimeValidator;


class DateTimeValidatorTest extends SimpleValidationTestCase {
    public function testValidate() {
        $validator = new DateTimeValidator();

        $valid   = [true, ''];
        $invalid = [false, $validator::message];

        // valid tests
        $result = $validator->validate('dummy', '2012-12-12 11:11:11');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('dummy', '2012/12/12 11:11:11');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('dummy', '2012.12.12 11:11:11');
        $this->assertEquals($result, $valid);

        // invaid tests
        $result = $validator->validate('dummy', '2012-12-12-11:11:11');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('dummy', '2012/12 11:11:11');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('dummy', '2012.12.12 11:11:qq');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('dummy', './*+~!@#$%^&*abcdefhijklmno_01234-pqrstuvwxyz_56789');
        $this->assertEquals($result, $invalid);
    }
}
