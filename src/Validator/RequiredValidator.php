<?php
namespace Symfu\SimpleValidation\Validator;

use Symfu\SimpleValidation\ValidatorInterface;

class RequiredValidator implements ValidatorInterface {
    const message = 'simple_validation.errors.required';

    public function validate($value, $argument = null, $fieldName = null, $formValues = []) {
        return strlen($value) > 0 ? [true, ''] : [false, self::message];
    }

    public function toJQueryValidateRule($argument) {
        return ['required' => true];
    }
}
