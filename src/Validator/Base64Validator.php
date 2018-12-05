<?php
namespace Symfu\SimpleValidation\Validator;

use Symfu\SimpleValidation\ValidatorInterface;

class Base64Validator implements ValidatorInterface {
    const message = 'simple_validation.errors.base64';

    public function validate($value, $argument = null, $fieldName = null, $formValues = []) {
        if (base64_decode($value)) {
            return [true, ''];
        } else {
            return [false, self::message];
        }
    }

    public function toJQueryValidateRule($argument) { }
}
