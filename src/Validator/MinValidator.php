<?php
namespace Symfu\SimpleValidation\Validator;

use Symfu\SimpleValidation\ValidatorInterface;

class MinValidator implements ValidatorInterface {
    const message = 'validation.errors.min';

    public function validate($value, $argument = null, $fieldName = null, $formValues = []) {
        if(!is_numeric($argument)) {
            throw new \InvalidArgumentException('Invalid argument for ' . self::class);
        }

        if ((float)$value >= (float)$argument) {
            return [true, null];
        } else {
            return [false, self::message];
        }
    }

    public function toJQueryValidateRule($argument) {
        return ['min' => (int)$argument];
    }
}
