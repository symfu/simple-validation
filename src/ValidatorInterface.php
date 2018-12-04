<?php
namespace Symfu\SimpleValidation;

interface ValidatorInterface
{
    public function validate($fieldName, $value, $formValues = []);
    public function setArgument($arg);
    public function toJQueryValidateRule();
}
