<?php
namespace Symfu\SimpleValidation\Validator;

class MinLengthValidator extends BaseValidator
{
    const message = 'simple_validation.errors.min_length';

    public function validate($fieldName, $value, $formValues = [])
    {
        $minLen = trim($this->args);
        if(strlen($minLen) < 1 || preg_match('/[^0-9]/', $minLen))
        {
            trigger_error("Validator args is invalid: {$this->args}", E_USER_WARNING);
            return [false, self::message];
        }

        $minLen = (int)$minLen;
        $valueLength = function_exists('mb_strlen') ? mb_strlen($value) : strlen($value);

        if($valueLength > 0 && $valueLength < $minLen)
        {
            return [false, self::message];
        }

        return [true, ''];
    }

    public function toJQueryValidateRule()
    {
        $len = (int)$this->args;
        return array('minlength' => $len);
    }
}
