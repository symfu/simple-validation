<?php
namespace Symfu\SimpleValidation\Validator;

use Symfu\SimpleValidation\ValidatorInterface;

class IdCardValidator implements ValidatorInterface {

    const message = 'simple_validation.errors.id_card';

    public function validate($fieldName, $value, $formValues = []) {
        $isValid = self::isValid($value);
        return [$isValid, $isValid ? '' : static::message];
    }

    /**
     * 验证身份证格式是否正确
     */
    public static function isValid($card_id) {
        // 只做18位身份号码检测
        if (strlen($card_id) !== 18) {
            return false;
        }

        $last_check_code = [1, 0, 'X', 9, 8, 7, 6, 5, 4, 3, 2,];
        if ((int)(substr($card_id, 6, 4)) % 4 == 0 || ((int)(substr($card_id, 6, 4)) % 100 == 0 && (int)(substr($card_id, 6, 4)) % 4 == 0)) {
            $ereg = '/^[1-9][0-9]{5}(19|20)[0-9]{2}((01|03|05|07|08|10|12)(0[1-9]|[1-2][0-9]|3[0-1])|(04|06|09|11)(0[1-9]|[1-2][0-9]|30)|02(0[1-9]|[1-2][0-9]))[0-9]{3}[0-9Xx]$/';//闰年出生日期的合法性正则表达式
        } else {
            $ereg = '/^[1-9][0-9]{5}(19|20)[0-9]{2}((01|03|05|07|08|10|12)(0[1-9]|[1-2][0-9]|3[0-1])|(04|06|09|11)(0[1-9]|[1-2][0-9]|30)|02(0[1-9]|1[0-9]|2[0-8]))[0-9]{3}[0-9Xx]$/';//平年出生日期的合法性正则表达式
        }

        if (!preg_match($ereg, $card_id)) {  //测试出生日期的合法性
            return false;
        }

        //计算校验位
        $S   = ((int)$card_id[0] + (int)$card_id[10]) * 7
            + ((int)$card_id[1] + (int)$card_id[11]) * 9
            + ((int)$card_id[2] + (int)$card_id[12]) * 10
            + ((int)$card_id[3] + (int)$card_id[13]) * 5
            + ((int)$card_id[4] + (int)$card_id[14]) * 8
            + ((int)$card_id[5] + (int)$card_id[15]) * 4
            + ((int)$card_id[6] + (int)$card_id[16]) * 2
            + (int)$card_id[7] * 1
            + (int)$card_id[8] * 6
            + (int)$card_id[9] * 3;
        $Y   = $S % 11;
        $M   = "F";
        $JYM = "10X98765432";
        $M   = $JYM . substr($Y, 1);//判断校验位
        if ($card_id['17'] === 'x' || $card_id['17'] === 'X') {
            $check = 'X';
        } else {
            $check = $card_id['17'];
        }

        return (string)$last_check_code[$Y] === $check;
    }

    public function setArgument($arg) {

    }

    public function toJQueryValidateRule() {

    }
}
