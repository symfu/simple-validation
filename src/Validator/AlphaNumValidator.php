<?php
namespace Symfu\SimpleValidation\Validator;

class AlphaNumValidator extends RegexValidator {
    const message = 'simple_validation.errors.alpha_num';
    const PATTERN = '/^[a-z0-9]+$/i';

    public function validate($value, $argument = null, $fieldName = null, $formValues = []) {
        return parent::validate($value, self::PATTERN, $fieldName, $formValues);
    }

    public function toJQueryValidateRule($argument) {
        return parent::toJQueryValidateRule(self::PATTERN);
    }
}
