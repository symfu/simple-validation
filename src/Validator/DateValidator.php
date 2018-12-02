<?php
namespace Symfu\SimpleValidation\Validator;

class DateValidator extends RegexValidator
{
    const message = 'simple_validation.errors.date';

    public function __construct()
    {
        $this->args = '/^\d\d\d\d[-\/\.]\d\d[-\/\.]\d\d$/';
    }

    public function validate($fieldName, $value, $formValues = [])
    {
        return parent::validate($fieldName, $value, $formValues);
    }

    public function toJQueryValidateRule()
    {
        return ['date' => true, 'regex' => $this->args];
    }
}
