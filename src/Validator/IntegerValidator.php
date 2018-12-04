<?php
namespace Symfu\SimpleValidation\Validator;

class IntegerValidator extends RegexValidator {
    const message = 'simple_validation.errors.integer';

    public function __construct() {
        $this->pattern = $this->jsPattern = '/^[\-+]?[0-9]+$/';
    }

    public function toJQueryValidateRule() {
        return ['number' => true, 'regex' => $this->jsPattern];
    }
}
