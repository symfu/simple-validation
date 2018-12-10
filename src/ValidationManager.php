<?php
namespace Symfu\SimpleValidation;

use Symfu\SimpleValidation\Validator\RequiredValidator;

class ValidationManager {
    private $jsRules = null;

    public function __construct() {
    }

    public function register($validatorName, $validator) {
        if(($validator instanceof ValidatorInterface) || !is_callable($validator)) {
            throw new \InvalidArgumentException('Argument for $validatorMgr must be an instance of ValidatorInterface or a callable');
        }
        $registry = Registry::getRegistry(Constants::CUSTOM_VALIDATORS);
        $registry->set($validatorName, $validator);
    }

    public function validate($formValues, $fieldDefinitions) {
        $allValid = true;
        $errors   = [];

        foreach ($fieldDefinitions as $fieldName => $fieldDef) {
            $value = isset($formValues[$fieldName]) ? $formValues[$fieldName] : null;
            list($validatorLiterals) = $fieldDef;
            if ($validatorLiterals) {
                if(is_string($validatorLiterals)) {
                    $validatorLiterals = preg_split('/\s*,\s*/', $validatorLiterals);
                }
                $validators = [];
                foreach ($validatorLiterals as $validatorLiteral) {
                    $validator = Utils::parseValidator($validatorLiteral);
                    $validators[] = $validator;
                }

                list($fieldValid, $validationError) = $this->validateField($value, $validators, $fieldName, $formValues);
                if (!$fieldValid) {
                    $allValid           = false;
                    $errors[$fieldName] = $validationError;
                }
            }
        }

        return [$allValid, $errors];
    }

    private function validateField($value, $validators, $fieldName, $formValues) {
        foreach ($validators as list($validator, $validatorArgs)) {
            // empty value should passes all validators, except RequiredValidator
            if(strlen($value) === 0 && !($validator instanceof RequiredValidator)) {
                continue;
            }

            if (is_callable($validator)) {
                list($succeed, $errorMessageKey) = call_user_func($validator, $value, $validatorArgs, $fieldName, $formValues);
            } elseif ($validator instanceOf ValidatorInterface) {
                list($succeed, $errorMessageKey) = $validator->validate($value, $validatorArgs, $fieldName, $formValues);
            } else {
                throw new \InvalidArgumentException("Invalid validator in field {$fieldName}");
            }

            if (!$succeed) {
                return [false, new ValidationError($errorMessageKey, $validatorArgs)];
            }
        }

        return [true, null];
    }


    public function generateJQueryValidateRules($fieldDefinitions, $fieldNames = []) {
        if (null !== $this->jsRules) {
            return $this->jsRules;
        }

        $this->jsRules = [];

        $fieldNames = $fieldNames ?: array_keys($fieldDefinitions);
        foreach ($fieldNames as $fieldName) {
            if (!isset($fieldDefinitions[$fieldName])) {
                throw new \InvalidArgumentException("Undefined field: {$fieldName}");
            }

            $fieldDef = $fieldDefinitions[$fieldName];
            list($validatorInfos, $_) = $fieldDef;
            if (is_string($validatorInfos)) {
                $validatorInfos = preg_split('/\s*,\s*/', $validatorInfos);
            }

            $fieldRules = [];
            foreach ($validatorInfos as $info) {
                list($validator, $args) = Utils::parseValidator($info);
                if (!($validator instanceOf ValidatorInterface)) {
                    continue;
                }

                $rule = $validator->toJQueryValidateRule();
                if ($rule) {
                    $fieldRules = array_merge($fieldRules, $rule);
                }
            }

            if ($fieldRules) {
                $this->jsRules[$fieldName] = $fieldRules;
            }
        }

        return $this->jsRules;
    }
}
