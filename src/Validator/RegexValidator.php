<?php
namespace Symfu\SimpleValidation\Validator;

use Symfu\SimpleValidation\ValidatorInterface;

class RegexValidator implements ValidatorInterface {
    const message = 'validation.errors.regex';

    public function validate($value, $argument = null, $fieldName = null, $formValues = []) {
        if (preg_match($argument, $value)) {
            return [true, null];
        } else {
            return [false, static::message];
        }

    }

    public function toJQueryValidateRule($argument) {
        if (strlen($argument) < 1) {
            return null;
        }

        return ['regex' => $argument];
    }
}
