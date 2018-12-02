<?php
namespace Symfu\SimpleValidation\Validator;

class AlphaNumericValidator extends RegexValidator
{
    const message = 'simple_validation.errors.alpha_numeric';

    public function __construct()
    {
        $this->args = $this->jsPattern = '/^[a-z0-9]+$/i';
    }

    public function validate($fieldName, $value, $formValues = [])
    {
        return parent::validate($fieldName, $value, $formValues);
    }
}
