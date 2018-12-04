<?php
namespace Symfu\SimpleValidation\Validator;

use Symfu\SimpleValidation\ValidatorInterface;

class RequiredValidator implements ValidatorInterface {
    const message = 'simple_validation.errors.required';

    public function validate($fieldName, $value, $formValues = []) {
        return strlen($value) > 0 ? [true, ''] : [false, self::message];
    }

    public function setArgument($arg) { }

    public function toJQueryValidateRule() {
        return ['required' => true];
    }
}
