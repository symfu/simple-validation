<?php
namespace Symfu\SimpleValidation\Validator;

class AlphaValidator extends RegexValidator {
    const message = 'simple_validation.errors.alpha';

    public function __construct() {
        $this->pattern = $this->jsPattern = '/^[a-z]+$/i';
    }
}
