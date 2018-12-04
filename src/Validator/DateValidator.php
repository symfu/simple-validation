<?php
namespace Symfu\SimpleValidation\Validator;

class DateValidator extends RegexValidator {
    const message = 'simple_validation.errors.date';

    public function __construct() {
        $this->pattern = '/^\d\d\d\d[-\/\.]\d\d[-\/\.]\d\d$/';
    }

    public function toJQueryValidateRule() {
        return ['date' => true, 'regex' => $this->pattern];
    }
}
