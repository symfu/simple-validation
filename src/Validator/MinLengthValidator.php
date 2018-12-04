<?php
namespace Symfu\SimpleValidation\Validator;

use Symfu\SimpleValidation\ValidatorInterface;

class MinLengthValidator implements ValidatorInterface {
    const message = 'simple_validation.errors.min_length';
    protected $minLength = null;

    public function __construct($arg = null) {
        if($arg) {
            $this->setArgument($arg);
        }
    }

    public function validate($fieldName, $value, $formValues = []) {
        $valueLength = function_exists('mb_strlen') ? mb_strlen($value) : strlen($value);
        if ($valueLength > 0 && $valueLength < $this->minLength) {
            return [false, self::message];
        }

        return [true, ''];
    }

    public function setArgument($minLength) {
        if (strlen($minLength) < 1 || preg_match('/[^0-9]/', $minLength)) {
            throw new \InvalidArgumentException("Arg for MinLengthValidator is invalid: {$minLength}");
        }

        $this->minLength = (int)$minLength;
    }

    public function toJQueryValidateRule() {
        return ['minlength' => $this->minLength];
    }

}
