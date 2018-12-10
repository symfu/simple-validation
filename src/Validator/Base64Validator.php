<?php
namespace Symfu\SimpleValidation\Validator;

use Symfu\SimpleValidation\ValidatorInterface;

class Base64Validator implements ValidatorInterface {
    const message = 'validation.errors.base64';

    public function validate($value, $argument = null, $fieldName = null, $formValues = []) {
        if (base64_decode($value)) {
            return [true, null];
        } else {
            return [false, self::message];
        }
    }

    public function toJQueryValidateRule($argument) { }
}
