<?php
namespace Symfu\SimpleValidation\Validator;

class NumericValidator extends BaseValidator
{
    const message = 'simple_validation.errors.numeric';

    public function validate($fieldName, $value, $formValues = [])
    {
        $result = (strlen($value) < 1 || is_numeric($value)) ? [true, ''] : [false, self::message];
        return $result;
    }

    public function toJQueryValidateRule()
    {
        return ['number' => true];
    }

}
