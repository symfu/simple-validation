<?php
namespace Symfu\SimpleValidation\Validator;

class MobileNumberValidator extends RegexValidator
{
    const message = 'simple_validation.errors.mobile';
    const PATTERN = '/^1\d{10}$/';
    public function __construct()
    {
        parent::__construct(self::PATTERN);
    }

    public function toJQueryValidateRule()
    {
        return array('regex' => self::PATTERN);
    }
}
