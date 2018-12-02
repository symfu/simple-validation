<?php
namespace Symfu\SimpleValidation\Validator;

class Base64Validator extends RegexValidator
{
    const message = 'simple_validation.errors.base64';

    public function __construct()
    {
        $this->args = $this->jsPattern = '/^[a-zA-Z0-9\/\+=]*$/';
    }

    public function validate($fieldName, $value, $formValues = [])
    {
        if(strlen($value) === 0)
        {
            return [true, ''];
        }
        else
        {
            list($valid, $_) = parent::validate($fieldName, $value, $formValues);
            $result = $valid ? [true, ''] : [false, self::message];
            return $result;
        }
    }
}
