<?php
namespace Symfu\SimpleValidation;

interface ValidationManagerInterface {
    public function register($validatorName, $validator);

    public function validate($formValues, $fieldDefinitions);
}
