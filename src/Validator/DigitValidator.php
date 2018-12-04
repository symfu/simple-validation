<?php
namespace Symfu\SimpleValidation\Validator;

class DigitValidator extends RegexValidator {
    const message = 'simple_validation.errors.digit';

    public function __construct() {
        $this->pattern = '/^[0-9]+$/';
    }

    public function toJQueryValidateRule() {
        return ['digits' => true];
    }
}
