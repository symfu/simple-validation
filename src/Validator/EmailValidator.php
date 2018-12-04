<?php
namespace Symfu\SimpleValidation\Validator;

class EmailValidator extends RegexValidator {
    const message = 'simple_validation.errors.email';

    public function __construct() {
        $this->pattern = '/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/i';
    }

    public function toJQueryValidateRule() {
        return ['email' => true];
    }
}
