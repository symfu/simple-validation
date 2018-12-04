<?php
namespace Symfu\SimpleValidation\Validator;

class AlphaDashValidator extends RegexValidator {
    const message = 'simple_validation.errors.alpha_dash';

    public function __construct() {
        $this->pattern = $this->jsPattern = '/^[a-z0-9_-]+$/i';
    }
}
