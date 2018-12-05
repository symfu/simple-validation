<?php
namespace Symfu\SimpleValidation\Validator;

class DecimalValidator extends RegexValidator {
    const message = 'simple_validation.errors.decimal';
    const PATTERN = '/^[+\-]?[0-9]+(?:[.][0-9]*)?$/';

    public function validate($value, $argument = null, $fieldName = null, $formValues = []) {
        return parent::validate($value, self::PATTERN, $fieldName, $formValues);
    }

    public function toJQueryValidateRule($argument) {
        return ['number' => true, 'regex' => self::PATTERN];
    }
}
