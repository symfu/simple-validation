<?php
namespace Symfu\SimpleValidation\Validator;

use Symfu\SimpleValidation\ValidatorInterface;

class NumericValidator implements ValidatorInterface {
    const message = 'validation.errors.numeric';

    public function validate($value, $argument = null, $fieldName = null, $formValues = []) {
        if (strlen($value) === 0 || is_numeric($value)) {
            return [true, null];
        } else {
            return [false, self::message];
        }
    }

    public function toJQueryValidateRule($argument) {
        return ['number' => true];
    }
}
