<?php
namespace Symfu\SimpleValidation\Validator;

class AlphaValidator extends RegexValidator {
    const message = 'validation.errors.alpha';
    const PATTERN = '/^[a-z]+$/i';

    public function validate($value, $argument = null, $fieldName = null, $formValues = []) {
        return parent::validate($value, self::PATTERN, $fieldName, $formValues);
    }

    public function toJQueryValidateRule($argument) {
        return parent::toJQueryValidateRule(self::PATTERN);
    }
}
