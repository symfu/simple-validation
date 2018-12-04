<?php
namespace Symfu\SimpleValidation\Validator;

use Symfu\SimpleValidation\ValidatorInterface;

class Base64Validator implements ValidatorInterface {
    const message = 'simple_validation.errors.base64';

    public function validate($fieldName, $value, $formValues = []) {
        if (strlen($value) === 0 || base64_decode($value)) {
            return [true, ''];
        } else {
            return [false, self::message];
        }
    }

    public function setArgument($arg) { }

    public function toJQueryValidateRule() { }
}
