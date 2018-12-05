<?php
namespace Symfu\SimpleValidation\Validator;

use Symfu\SimpleValidation\ValidatorInterface;

class EnumValidator implements ValidatorInterface {
    const message = 'simple_validation.errors.enum';

    public function validate($value, $argument = null, $fieldName = null, $formValues = []) {
        $enums = $this->parse($argument);

        if (in_array($value, $enums)) {
            return [true, ''];
        } else {
            return [false, self::message];
        }
    }

    protected function parse($enumValues) {
        $validEnums = null;
        if (is_string($enumValues)) {
            $validEnums = explode("|", trim($enumValues));
        } elseif (is_array($enumValues)) {
            $validEnums = array_values($enumValues);
        }

        if(!$validEnums) {
            throw new \InvalidArgumentException("Invalid arguments for EnumValidator: " . json_encode($enumValues));
        }

        array_walk($validEnums, function (&$v) { $v = trim($v); });
        $validEnums = array_filter($validEnums, function ($v) { return $v !== '' && $v !== null; });

        return $validEnums;
    }

    public function toJQueryValidateRule($argument) {
        return ['regex' => "/({$argument})/"];
    }
}
