<?php
namespace Symfu\SimpleValidation\Validator;

class MobileNumberValidator extends RegexValidator {
    const message = 'simple_validation.errors.mobile';
    const PATTERN = '/^1\d{10}$/';

    public function validate($value, $argument = null, $fieldName = null, $formValues = []) {
        return parent::validate($value, self::PATTERN, $fieldName, $formValues);
    }

    public function toJQueryValidateRule($argument) {
        return parent::toJQueryValidateRule(self::PATTERN);
    }
}
