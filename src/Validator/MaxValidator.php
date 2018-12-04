<?php
namespace Symfu\SimpleValidation\Validator;

use Symfu\SimpleValidation\ValidatorInterface;

class MaxValidator implements ValidatorInterface {
    const message = 'simple_validation.errors.max';
    protected $maxValue;

    public function __construct($arg = null) {
        if($arg) {
            $this->setArgument($arg);
        }
    }

    public function validate($fieldName, $value, $formValues = []) {
        return $value <= $this->maxValue ? [true, ''] : [false, self::message];
    }

    public function setArgument($maxLength) {
        if (strlen($maxLength) < 1 || preg_match('[^0-9]', $maxLength)) {
            throw new \InvalidArgumentException("Invalid argument for MaxValidator");
        }

        $this->maxValue = (int)$maxLength;
    }

    public function toJQueryValidateRule() {
        return ['max' => $this->maxValue];
    }
}
