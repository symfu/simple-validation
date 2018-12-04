<?php
namespace Symfu\SimpleValidation\Validator;

use Symfu\SimpleValidation\ValidatorInterface;

class MaxLengthValidator implements ValidatorInterface {
    const message = 'simple_validation.errors.max_length';

    protected $maxLength;

    public function __construct($arg = null) {
        if($arg) {
            $this->setArgument($arg);
        }
    }

    public function validate($fieldName, $value, $formValues = []) {
        $valueLength = function_exists('mb_strlen') ? mb_strlen($value) : strlen($value);
        if ($valueLength > $this->maxLength) {
            return [false, self::message];
        }

        return [true, ''];
    }

    public function setArgument($maxLength) {
        if (strlen($maxLength) < 1 || preg_match('/[^0-9]/', $maxLength)) {
            throw new \InvalidArgumentException("Invalid argument for " . static::class);
        }

        $this->maxLength = (int)$maxLength;
    }

    public function toJQueryValidateRule() {
        return ['maxlength' => $this->maxLength];
    }
}
