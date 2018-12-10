<?php
namespace Symfu\SimpleValidation\Validator;

use Symfu\SimpleValidation\ValidatorInterface;

class MaxValidator implements ValidatorInterface {
    const message = 'validation.errors.max';

    public function validate($value, $argument = null, $fieldName = null, $formValues = []) {
        if(!is_numeric($argument)) {
            throw new \InvalidArgumentException('Invalid argument for ' . self::class);
        }

        return (float)$value <= (float)$argument ? [true, null] : [false, self::message];
    }

    public function toJQueryValidateRule($argument) {
        return ['max' => (int)$argument];
    }
}
