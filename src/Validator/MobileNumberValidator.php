<?php
namespace Symfu\SimpleValidation\Validator;

class MobileNumberValidator extends RegexValidator {
    const message = 'simple_validation.errors.mobile';

    public function __construct() {
        $this->pattern = $this->jsPattern = '/^1\d{10}$/';
    }
}
