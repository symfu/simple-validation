<?php
namespace Symfu\SimpleValidation;

interface ValidatorInterface
{
    public function validate($value, $argument = null, $fieldName = null, $formValues = []);
    public function toJQueryValidateRule($argument);
}
