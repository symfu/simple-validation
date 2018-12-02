<?php
namespace Symfu\SimpleValidation\Validator;

class MatchesValidator extends BaseValidator
{
    const message = 'simple_validation.errors.matches';

    public function validate($fieldName, $value, $formValues = [])
    {
        $matchField = trim($this->args);
        if(!$matchField || !isset($formValues[$matchField]) || ($value !== $formValues[$matchField]))
        {
            return [false, self::message];
        }

        return [true, ''];
    }

    public function toJQueryValidateRule()
    {
        $target = $this->args;
        return array('equalTo' => $target);
    }
}
