<?php
namespace Symfu\SimpleValidation\Validator;

use Symfu\SimpleValidation\ValidatorInterface;

class MinValidator implements ValidatorInterface {
    const message = 'simple_validation.errors.min';
    protected $minValue = null;

    public function __construct($arg = null) {
        if($arg) {
            $this->setArgument($arg);
        }
    }

    public function validate($fieldName, $value, $formValues = []) {
        if (strlen($value) > 0 && $value < $this->minValue) {
            return [false, self::message];
        }

        return [true, ''];
    }

    public function setArgument($minValue) {
        if (strlen($minValue) < 1 || preg_match('/[^0-9]/', $minValue)) {
            throw new \InvalidArgumentException("Invalid argument for " . static::class);
        }

        $this->minValue = (int)$minValue;
    }

    public function toJQueryValidateRule() {
        $len = (int)$this->minValue;

        return ['min' => $len];
    }
}
