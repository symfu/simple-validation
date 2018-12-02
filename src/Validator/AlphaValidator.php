<?php
namespace Symfu\SimpleValidation\Validator;

class AlphaValidator extends RegexValidator
{
    const message = 'simple_validation.errors.alpha';

    public function __construct()
    {
        $this->args = $this->jsPattern = '/^[a-z]+$/i';
    }

    public function validate($fieldName, $value, $formValues = [])
    {
        return parent::validate($fieldName, $value, $formValues);
    }
}
