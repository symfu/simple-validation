<?php
namespace Symfu\SimpleValidation\Validator;

use Symfu\SimpleValidation\ValidatorInterface;

class MaxLengthValidator implements ValidatorInterface {
    const message = 'simple_validation.errors.max_length';

    public function validate($value, $argument = null, $fieldName = null, $formValues = []) {
        if(!preg_match('/^\d+$/', $argument)) {
            throw new \InvalidArgumentException('Invalid argument for ' . self::class);
        }

        $valueLength = function_exists('mb_strlen') ? mb_strlen($value) : strlen($value);
        if ($valueLength === 0 || $valueLength <= (int)$argument) {
            return [true, ''];
        } else {
            return [false, self::message];
        }
    }

    public function toJQueryValidateRule($argument) {
        return ['maxlength' => (int)$argument];
    }
}
