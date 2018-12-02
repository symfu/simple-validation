<?php
namespace Symfu\SimpleValidation\Validator;

class RequiredValidator extends BaseValidator {
    const message = 'simple_validation.errors.required';

    public function validate($fieldName, $value, $formValues = []) {
        if (strlen($value) > 0) {
            return [true, ''];
        }

        return $value ? [true, ''] : [false, self::message];
    }

    public function toJQueryValidateRule() {
        return ['required' => true];
    }

}
