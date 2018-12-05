<?php

namespace Symfu\SimpleValidation\Test\Validator;

use Symfu\SimpleValidation\Test\SimpleValidationTestCase;
use Symfu\SimpleValidation\Validator\MaxValidator;


class MaxValidatorTest extends SimpleValidationTestCase {
    public function testValidate() {
        $validator = new MaxValidator();

        $valid   = [true, ''];
        $invalid = [false, $validator::message];

        // valid
        $result = $validator->validate('98', '98');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('98', '99');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('98', '100');
        $this->assertEquals($result, $valid);

        $result    = $validator->validate('98.000', '98.001');
        $this->assertEquals($result, $valid);

        $result    = $validator->validate('0.0000', '0.0000');
        $this->assertEquals($result, $valid);

        $result    = $validator->validate('-1.001', '-1.0001');
        $this->assertEquals($result, $valid);

        $result    = $validator->validate('0.0000', '0.0001');
        $this->assertEquals($result, $valid);

        // invalid
        $result    = $validator->validate('99', '89');
        $this->assertEquals($result, $invalid);

        $result    = $validator->validate('99', '89.99999999');
        $this->assertEquals($result, $invalid);

        $result    = $validator->validate('20', '15');
        $this->assertEquals($result, $invalid);

        $result    = $validator->validate('-1', '-2');
        $this->assertEquals($result, $invalid);

        $result    = $validator->validate('-1.0001', '-1.0002');
        $this->assertEquals($result, $invalid);
    }
}
