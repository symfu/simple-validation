<?php
namespace Symfu\SimpleValidation\Validator;

use Symfu\SimpleValidation\ValidatorInterface;

class ExactLengthValidator implements ValidatorInterface {
    const message = 'simple_validation.errors.exact_length';
    protected $exactLength;

    public function __construct($arg = null) {
        if($arg) {
            $this->setArgument($arg);
        }
    }

    public function validate($fieldName, $value, $formValues = []) {
        if (strlen($value) === 0) {
            return [true, ''];
        }

        $valueLength = function_exists('mb_strlen') ? mb_strlen($value) : strlen($value);

        if ($valueLength !== $this->exactLength) {
            return [false, self::message];
        }

        return [true, ''];
    }

    public function setArgument($length) {
        if (strlen($length) < 1 || preg_match('[^0-9]', $length)) {
            throw new \InvalidArgumentException("Invalid argument for MaxValidator");
        }

        $this->exactLength = (int)$length;
    }

    public function toJQueryValidateRule() {

        return ['range' => [$this->exactLength, $this->exactLength]];
    }
}
