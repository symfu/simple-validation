<?php
namespace Symfu\SimpleValidation\Validator;

class DateValidator extends RegexValidator {
    const message = 'validation.errors.date';
    const PATTERN = '/^\d\d\d\d[-\/\.]\d\d[-\/\.]\d\d$/';

    public function validate($value, $argument = null, $fieldName = null, $formValues = []) {
        return parent::validate($value, self::PATTERN, $fieldName, $formValues);
    }

    public function toJQueryValidateRule($argument) {
        return ['regex' => self::PATTERN];
    }
}
