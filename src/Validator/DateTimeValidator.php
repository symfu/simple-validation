<?php
namespace Symfu\SimpleValidation\Validator;

class DateTimeValidator extends RegexValidator
{
    const message = 'simple_validation.errors.date_time';

    public function __construct()
    {
        $this->args = '/^\d\d\d\d[-\/\.]\d\d[-\/\.]\d\d\s+\d\d:\d\d:\d\d$/i';
    }

    public function validate($fieldName, $value, $formValues = [])
    {
        return parent::validate($fieldName, $value, $formValues);
    }

    public function toJQueryValidateRule()
    {
        return array('date' => true, 'regex' => $this->args);
    }
}
