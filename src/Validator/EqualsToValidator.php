<?php
namespace Symfu\SimpleValidation\Validator;

use Symfu\SimpleValidation\ValidatorInterface;

class EqualsToValidator implements ValidatorInterface {
    const message = 'simple_validation.errors.equals_to';
    protected $targetField;

    public function __construct($arg = null) {
        if($arg) {
            $this->setArgument($arg);
        }
    }

    public function validate($fieldName, $value, $formValues = []) {
        $matchField = $this->targetField;
        if (!$matchField || !isset($formValues[$matchField]) || ($value !== $formValues[$matchField])) {
            return [false, self::message];
        }

        return [true, ''];
    }

    public function setArgument($targetField) {
        if (strlen($targetField) < 1) {
            throw new \InvalidArgumentException("Invalid argument for " . static::class);
        }

        $this->targetField = $targetField;
    }

    public function toJQueryValidateRule() {
        return ['equalTo' => $this->targetField];
    }
}
