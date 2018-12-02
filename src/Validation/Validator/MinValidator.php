<?php
namespace Symfu\SimpleValidation\Validator;

class MinValidator extends BaseValidator
{
    const message = 'simple_validation.errors.min';

    public function validate($fieldName, $value, $formValues = [])
    {
        $compareTarget = trim($this->args);
        if(strlen($value) > 0 && (!is_numeric($value) || !is_numeric($compareTarget) || $value < $compareTarget))
        {
            return [false, self::message];
        }

        return [true, ''];
    }

    public function toJQueryValidateRule()
    {
        $len = (int)$this->args;
        return array('min' => $len);
    }
}
