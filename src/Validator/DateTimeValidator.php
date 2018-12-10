<?php
namespace Symfu\SimpleValidation\Validator;

use Symfu\SimpleValidation\ValidatorInterface;

class DateTimeValidator implements ValidatorInterface {
    const message = 'validation.errors.date_time';

    public function validate($value, $argument = null, $fieldName = null, $formValues = []) {
        return strtotime($value) ? [true, null] : [false, self::message];
    }

    public function toJQueryValidateRule($argument) {
        return ['date' => true];
    }
}
