<?php

namespace Symfu\SimpleValidation\Test\Validator;

use Symfu\SimpleValidation\Test\SimpleValidationTestCase;
use Symfu\SimpleValidation\Validator\DateTimeValidator;


class DateTimeValidatorTest extends SimpleValidationTestCase {
    public function testValidate() {
        $validator = new DateTimeValidator();

        $valid   = [true, null];
        $invalid = [false, $validator::message];

        // valid tests
        $result = $validator->validate('2012-11-12 11:11:11');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('2012/11/12 11:11:11');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('2012/12/12T11:11:11Z');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('Thu Jan 01 1970 07:00:00 GMT-0500');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('78-Dec-22');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('April 17, 1790');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('30-6-2008');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('30-June 2008');
        $this->assertEquals($result, $valid);

        // invaid tests
        $result = $validator->validate('2012.12.12 11:11:11');
        $this->assertEquals($result, $invalid);
        $result = $validator->validate('2012-12-12-11:11:11');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('2012/12 11:11:11');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('2012.12.12 11:11:qq');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('./*+~!@#$%^&*abcdefhijklmno_01234-pqrstuvwxyz_56789');
        $this->assertEquals($result, $invalid);
    }
}
