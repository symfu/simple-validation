<?php
namespace Symfu\SimpleValidation\Validator;

class AlphaDashValidator extends RegexValidator
{
    const message = 'simple_validation.errors.alpha_dash';

    public function __construct()
    {
        $this->args = $this->jsPattern = '/^[a-z0-9_-]+$/i';
    }

    public function validate($fieldName, $value, $formValues = [])
    {
        return parent::validate($fieldName, $value, $formValues);
    }
}
