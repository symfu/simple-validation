<?php
namespace Symfu\SimpleValidation\Validator;

class MaxValidator extends BaseValidator
{
    const message = 'simple_validation.errors.max';

    public function validate($fieldName, $value, $formValues = [])
    {
        $compareTarget = trim($this->args);
        if(strlen($value) > 0 && $value > $compareTarget)
        {
            return [false, self::message];
        }

        return [true, ''];
    }

    public function toJQueryValidateRule()
    {
        $len = (int)$this->args;
        return array('max' => $len);
    }
}
