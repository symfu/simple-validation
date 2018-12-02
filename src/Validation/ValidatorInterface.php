<?php
namespace Symfu\SimpleValidation;

interface ValidatorInterface
{
    public function validate($fieldName, $value, $formValues = []);
    public function setArgs($args);
    public function toJQueryValidateRule();
}
