<?php
namespace Symfu\SimpleValidation\Validator;

use Symfu\SimpleValidation\ValidatorInterface;

class EnumValidator implements ValidatorInterface {
    const message = 'simple_validation.errors.enum';

    protected $enums = [];
    public function __construct($enumValues = null, $useArrayKeys = false) {
        if($enumValues) {
            $this->setArgument($enumValues, $useArrayKeys);
        }
    }

    public function validate($fieldName, $value, $formValues = []) {
        if (strlen($value) > 0 && $this->enums && !in_array($value, $this->enums)) {
            return [false, self::message];
        }

        return [true, ''];
    }

    public function setArgument($enumValues, $useArrayKeys = false) {
        $validEnums = null;
        if (is_string($enumValues)) {
            $validEnums = explode("|", trim($enumValues));
        } elseif (is_array($enumValues)) {
            $validEnums = $useArrayKeys ? array_keys($enumValues) : array_values($enumValues);
        }

        if(!$validEnums) {
            throw new \InvalidArgumentException("Invalid arguments for EnumValidator: " . json_encode($enumValues));
        }

        array_walk($validEnums, function (&$v) { $v = trim($v); });
        $validEnums = array_filter($validEnums, function ($v) { return $v !== '' && $v !== null; });

        $this->enums = $validEnums;
    }

    public function toJQueryValidateRule() {
        $enumStr = join('|', $this->enums);
        return ['regex' => "/({$enumStr})/"];
    }
}
