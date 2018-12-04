<?php
namespace Symfu\SimpleValidation\Validator;

use Symfu\SimpleValidation\ValidatorInterface;

class DateTimeValidator implements ValidatorInterface {
    const message = 'simple_validation.errors.date_time';

    public function validate($fieldName, $value, $formValues = []) {
        return strtotime($value) ? [true, ''] : [false, self::message];
    }

    public function setArgument($arg) {}

    public function toJQueryValidateRule() {
        return ['date' => true];
    }
}
