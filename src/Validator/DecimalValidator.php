<?php
namespace Symfu\SimpleValidation\Validator;

class DecimalValidator extends RegexValidator {
    const message = 'simple_validation.errors.decimal';

    public function __construct() {
        $this->pattern = $this->jsPattern = '/^[+\-]?[0-9]+(?:[.][0-9]*)?$/';
    }

    public function toJQueryValidateRule() {
        return ['number' => true, 'regex' => $this->jsPattern];
    }
}
