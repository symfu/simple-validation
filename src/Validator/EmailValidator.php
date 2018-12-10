<?php
namespace Symfu\SimpleValidation\Validator;

class EmailValidator extends RegexValidator {
    const message = 'validation.errors.email';
    const PATTERN = '/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/i';

    public function validate($value, $argument = null, $fieldName = null, $formValues = []) {
        return parent::validate($value, self::PATTERN, $fieldName, $formValues);
    }

    public function toJQueryValidateRule($argument) {
        return ['email' => true];
    }
}
