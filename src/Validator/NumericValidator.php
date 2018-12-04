<?php
namespace Symfu\SimpleValidation\Validator;

use Symfu\SimpleValidation\ValidatorInterface;

class NumericValidator implements ValidatorInterface {
    const message = 'simple_validation.errors.numeric';

    public function validate($fieldName, $value, $formValues = []) {
        if (strlen($value) < 1 || is_numeric($value)) {
            return [true, ''];
        } else {
            return [false, self::message];
        }
    }

    public function toJQueryValidateRule() {
        return ['number' => true];
    }

    public function setArgument($arg) { }
}
