<?php

namespace Symfu\SimpleValidation\Test\Validator;

use Symfu\SimpleValidation\Test\SimpleValidationTestCase;
use Symfu\SimpleValidation\Validator\MinLengthValidator;


class MinLengthValidatorTest extends SimpleValidationTestCase {
    public function testValidate() {
        $validator = new MinLengthValidator('9');

        $valid   = [true, ''];
        $invalid = [false, $validator::message];

        // valid
        $result = $validator->validate('dummy', ''); // 空字符串是合法的
        $this->assertEquals($result, $valid);

        $result = $validator->validate('dummy', '123456789');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('dummy', 'abcdefghi');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('dummy', '不多不少正好九个字');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('dummy', '中英混合words');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('dummy', '超过九个字也是ok的');
        $this->assertEquals($result, $valid);

        // invalid
        // invalid args
        $result = $validator->validate('dummy', '6chars');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('dummy', '12345');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('dummy', '不到九个fail');
        $this->assertEquals($result, $invalid);
    }

    /**
     * @expectedException \PHPUnit\Framework\Error\Warning
     */
    public function testValidateFailed_1() {
        $validator = new MinLengthValidator('');
        $valid   = [true, ''];
        $invalid = [false, $validator::message];

        $result    = $validator->validate('dummy', '6chars');
        $this->assertEquals($result, $invalid);
    }

    /**
     * @expectedException \PHPUnit\Framework\Error\Warning
     */
    public function testValidateFailed_2() {
        $validator = new MinLengthValidator('a123');
        $valid   = [true, ''];
        $invalid = [false, $validator::message];

        $result    = $validator->validate('dummy', '6chars');
        $this->assertEquals($result, $invalid);
    }

    /**
     * @expectedException \PHPUnit\Framework\Error\Warning
     */
    public function testValidateFailed_3() {
        $validator = new MinLengthValidator('23*');
        $valid   = [true, ''];
        $invalid = [false, $validator::message];

        $result    = $validator->validate('dummy', '6chars');
        $this->assertEquals($result, $invalid);
    }
}
