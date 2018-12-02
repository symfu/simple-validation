<?php
namespace Symfu\SimpleValidation\Validator;

class EmailValidator extends RegexValidator
{
    const message = 'simple_validation.errors.email';

    public function __construct()
    {
        $this->args = '/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/i';
    }

    public function validate($fieldName, $value, $formValues = [])
    {
        return parent::validate($fieldName, $value, $formValues);
    }

    public function toJQueryValidateRule()
    {
        return array('email' => true);
    }
}
