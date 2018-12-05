<?php
namespace Symfu\SimpleValidation\Validator;

class DigitValidator extends RegexValidator {
    const message = 'simple_validation.errors.digit';
    const PATTERN = '/^[0-9]+$/';

    public function validate($value, $argument = null, $fieldName = null, $formValues = []) {
        return parent::validate($value, self::PATTERN, $fieldName, $formValues);
    }

    public function toJQueryValidateRule($argument) {
        return ['digits' => true];
    }
}
