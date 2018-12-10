<?php
namespace Symfu\SimpleValidation\Validator;

class IntegerValidator extends RegexValidator {
    const message = 'validation.errors.integer';
    const PATTERN = '/^[\-+]?[0-9]+$/';

    public function validate($value, $argument = null, $fieldName = null, $formValues = []) {
        return parent::validate($value, self::PATTERN, $fieldName, $formValues);
    }

    public function toJQueryValidateRule($argument) {
        return ['number' => true, 'regex' => self::PATTERN];
    }
}
