<?php

namespace Symfu\SimpleValidation\Test\Validator;

use Symfu\SimpleValidation\Test\SimpleValidationTestCase;
use Symfu\SimpleValidation\Validator\MinLengthValidator;


class MinLengthValidatorTest extends SimpleValidationTestCase {
    public function testValidate() {
        $validator = new MinLengthValidator();

        $valid   = [true, ''];
        $invalid = [false, $validator::message];

        // valid
        $result = $validator->validate('', '9'); // 空字符串是合法的
        $this->assertEquals($result, $valid);

        $result = $validator->validate('123456789', '9');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('abcdefghi', '9');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('不多不少正好九个字', '9');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('中英混合words', '9');
        $this->assertEquals($result, $valid);

        $result = $validator->validate('超过九个字也是ok的', '9');
        $this->assertEquals($result, $valid);

        // invalid
        // invalid args
        $result = $validator->validate('6chars', '9');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('12345', '9');
        $this->assertEquals($result, $invalid);

        $result = $validator->validate('不到九个fail', '9');
        $this->assertEquals($result, $invalid);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testValidateFailed_2() {
        $validator = new MinLengthValidator();
        $validator->validate('9', 'a123');
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testValidateFailed_3() {
        $validator = new MinLengthValidator();
        $validator->validate('9', '23*');
    }
}
