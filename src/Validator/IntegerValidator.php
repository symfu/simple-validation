<?php
namespace Symfu\SimpleValidation\Validator;

class IntegerValidator extends RegexValidator
{
    const message = 'simple_validation.errors.integer';

    public function __construct()
    {
        parent::__construct('/^[\-+]?[0-9]+$/');
        $this->jsPattern = $this->args;
    }

    public function validate($fieldName, $value, $formValues = [])
    {
        return parent::validate($fieldName, $value, $formValues);
    }

    public function toJQueryValidateRule()
    {
        return ['number' => true, 'regex' => $this->jsPattern];
    }
}
