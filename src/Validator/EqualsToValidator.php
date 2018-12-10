<?php
namespace Symfu\SimpleValidation\Validator;

use Symfu\SimpleValidation\ValidatorInterface;

class EqualsToValidator implements ValidatorInterface {
    const message = 'validation.errors.equals_to';

    public function validate($value, $argument = null, $fieldName = null, $formValues = []) {
        if(!$argument || !isset($formValues[$argument])) {
            throw new \InvalidArgumentException('Invalid argument for ' . self::class);
        }

        if ((string)$value === (string)$formValues[$argument]) {
            return [true, null];
        } else {
            return [false, self::message];
        }
    }

    public function toJQueryValidateRule($argument) {
        return ['equalTo' => $argument];
    }
}
