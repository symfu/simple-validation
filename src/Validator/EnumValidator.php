<?php
namespace Symfu\SimpleValidation\Validator;

class EnumValidator extends BaseValidator
{
    const message = 'simple_validation.errors.enum';
    private $useArrayKeys = false;
    public function __construct($enumValues = null, $useArrayKeys = false) {
        parent::__construct();
        $this->useArrayKeys = $useArrayKeys;

        $this->setArgs($enumValues);
    }

    public function validate($fieldName, $value, $formValues = [])
    {
        if(strlen($value) > 0 && $this->args && !in_array($value, (array)$this->args))
        {
            return [false, self::message];
        }

        return [true, ''];
    }

    public function setArgs($enumValues) {
        if(is_string($enumValues)) {
            $validEnums = explode("|", trim($enumValues));
        } elseif(is_array($enumValues)) {
            $validEnums = $this->useArrayKeys ? array_keys($enumValues) : array_values($enumValues);
        } else {
            $validEnums = [];
        }

        array_walk($validEnums, function(&$v){ $v = trim($v);});
        $validEnums = array_filter($validEnums, function($v){ return $v !== '' && $v !== null;});

        $this->args = $validEnums;
    }

    public function toJQueryValidateRule()
    {
        return [];
    }
}
