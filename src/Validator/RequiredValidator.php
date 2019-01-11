<?php
namespace Symfu\SimpleValidation\Validator;

use Symfu\SimpleValidation\ValidatorInterface;

class RequiredValidator implements ValidatorInterface {
    const message = 'validation.errors.required';

    public function validate($value, $argument = null, $fieldName = null, $formValues = []) {
        $valid = false;
        if(is_string($value)) {
            $valid = strlen($value) > 0;
        } else {
            $valid = (bool)$value;
        }

        return $valid  ? [true, null] : [false, self::message];
    }

    public function toJQueryValidateRule($argument) {
        return ['required' => true];
    }
}
