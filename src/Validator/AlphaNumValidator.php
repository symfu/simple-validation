<?php
namespace Symfu\SimpleValidation\Validator;

class AlphaNumValidator extends RegexValidator {
    const message = 'simple_validation.errors.alpha_num';

    public function __construct() {
        $this->pattern = $this->jsPattern = '/^[a-z0-9]+$/i';
    }
}
