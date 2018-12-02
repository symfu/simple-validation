<?php

namespace Symfu\SimpleValidation\Validator;

class ExactLengthValidator extends BaseValidator {
    const message = 'simple_validation.errors.exact_length';

    public function validate($fieldName, $value, $formValues = []) {
        if (strlen($value) === 0) {
            return [true, ''];
        }

        $len = trim($this->args);
        if (strlen($len) < 1 || preg_match('/[^0-9]/', $len)) {
            trigger_error("Invalid length argument: {$len}", E_USER_WARNING);

            return [false, self::message];
        }

        $len         = (int)$len;
        $valueLength = function_exists('mb_strlen') ? mb_strlen($value) : strlen($value);

        if ($valueLength !== $len) {
            return [false, self::message];
        }

        return [true, ''];
    }

    public function toJQueryValidateRule() {
        $len = (int)$this->args;

        return ['range' => [$len, $len]];
    }
}
