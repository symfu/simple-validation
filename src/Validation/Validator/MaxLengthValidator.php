<?php
namespace Symfu\SimpleValidation\Validator;

class MaxLengthValidator extends BaseValidator
{
    const message = 'simple_validation.errors.max_length';

    public function validate($fieldName, $value, $formValues = [])
    {
        $maxLen = $this->args;
        if(strlen($maxLen) < 1 || preg_match('/[^0-9]/', $maxLen))
        {
            throw new \InvalidArgumentException("Argument for MaxLengthValidator is invalid, field={$fieldName}");
        }

        $maxLen = (int)$maxLen;
        $valueLength = function_exists('mb_strlen') ? mb_strlen($value) : strlen($value);

        if($valueLength > $maxLen)
        {
            return [false, self::message];
        }

        return [true, ''];
    }

    public function toJQueryValidateRule()
    {
        $len = (int)$this->args;
        return ['maxlength' => $len];
    }
}
