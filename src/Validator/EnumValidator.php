<?php
namespace Symfu\SimpleValidation\Validator;

use Symfu\SimpleValidation\ValidatorInterface;

class EnumValidator implements ValidatorInterface {

    const message = 'validation.errors.enum';

    public function validate($value, $argument = null, $fieldName = null, $formValues = []) {
        if ((is_scalar($value) && strlen($value) === 0) || (is_array($value) && !$value)) {
            return [true, null];
        }

        $enums = $this->parse($argument);

        if (is_array($value)) {
            // 如果不是所有值都在枚举范围内，返回 false，否则返回 true
            return array_diff($value, $enums) ? [false, self::message] : [true, null];
        } else {
            // 如果值不在枚举范围内，返回 false，否则返回 true
            return !in_array($value, $enums)  ? [false, self::message] : [true, null];
        }
    }

    protected function parse($enumValues) {
        $validEnums = null;
        if (is_string($enumValues)) {
            $validEnums = explode("|", trim($enumValues));
        } elseif (is_array($enumValues)) {
            $validEnums = array_values($enumValues);
        }

        if (!$validEnums) {
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
