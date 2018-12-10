<?php
namespace Symfu\SimpleValidation\Validator;

class AlphaDashValidator extends RegexValidator {
    const message = 'validation.errors.alpha_dash';
    const PATTERN = '/^[a-z0-9_-]+$/i';

    public function validate($value, $argument = null, $fieldName = null, $formValues = []) {
        return parent::validate($value, self::PATTERN, $fieldName, $formValues);
    }

    public function toJQueryValidateRule($argument) {
        return parent::toJQueryValidateRule(self::PATTERN);
    }
}
