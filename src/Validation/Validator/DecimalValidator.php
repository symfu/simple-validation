<?php
namespace Symfu\SimpleValidation\Validator;

class DecimalValidator extends RegexValidator
{
    const message = 'simple_validation.errors.decimal';

    public function __construct()
    {
        parent::__construct('/^[+\-]?[0-9]+(?:[.][0-9]*)?$/');
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
