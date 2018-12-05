<?php

namespace Symfu\SimpleValidation\Test\Validator;

use Symfu\SimpleValidation\Test\SimpleValidationTestCase;
use Symfu\SimpleValidation\Validator\MinValidator;


class MinValidatorTest extends SimpleValidationTestCase {
    public function testValidate() {
        $validator = new MinValidator();

        $valid   = [true, ''];
        $invalid = [false, $validator::message];

        // valid
        $result = $validator->validate('99', 98);
        $this->assertEquals($result, $valid);

        $result    = $validator->validate('100', 99);
        $this->assertEquals($result, $valid);

        $result    = $validator->validate('100', 100);
        $this->assertEquals($result, $valid);

        $result    = $validator->validate('0.000000000001', 0);
        $this->assertEquals($result, $valid);

        $result    = $validator->validate('0', -0.000000001);
        $this->assertEquals($result, $valid);

        $result    = $validator->validate('-1', -1.0000000001);
        $this->assertEquals($result, $valid);

        $result    = $validator->validate('-1', -2);
        $this->assertEquals($result, $valid);

        // invalid
        $result    = $validator->validate('100', 101);
        $this->assertEquals($result, $invalid);

        $result    = $validator->validate('15', '20');
        $this->assertEquals($result, $invalid);

        $result    = $validator->validate('-1', '-0.99999999999');
        $this->assertEquals($result, $invalid);

        $result    = $validator->validate('-1', '0');
        $this->assertEquals($result, $invalid);

        $result    = $validator->validate('0', '0.0000000001');
        $this->assertEquals($result, $invalid);
    }
}
