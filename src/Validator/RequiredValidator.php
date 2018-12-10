<?php
namespace Symfu\SimpleValidation\Validator;

use Symfu\SimpleValidation\ValidatorInterface;

class RequiredValidator implements ValidatorInterface {
    const message = 'validation.errors.required';

    public function validate($value, $argument = null, $fieldName = null, $formValues = []) {
        return strlen($value) > 0 ? [true, null] : [false, self::message];
    }

    public function toJQueryValidateRule($argument) {
        return ['required' => true];
    }
}
