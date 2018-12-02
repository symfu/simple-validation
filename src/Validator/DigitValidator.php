<?php
namespace Symfu\SimpleValidation\Validator;

class DigitValidator extends RegexValidator
{
    const message = 'simple_validation.errors.digit';

    public function __construct()
    {
        parent::__construct('/^[0-9]+$/');
    }

    public function toJQueryValidateRule()
    {
        return array('number' => true, 'digits' => true);
    }
}
