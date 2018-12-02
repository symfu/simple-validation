<?php
namespace Symfu\SimpleValidation;

class ValidationManager {
    private $jsRules = null;

    public function __construct() {
    }

    public function register($validatorName, $validator) {
        if(($validator instanceof ValidatorInterface) || !is_callable($validator)) {
            throw new \InvalidArgumentException('Argument for $validator must be an instance of ValidatorInterface or a callable');
        }
        $registry = Registry::getRegistry(Constants::CUSTOM_VALIDATORS);
        $registry->set($validatorName, $validator);
    }

    public function validate($formValues, $fieldDefinitions) {
        $allValid = true;
        $errors   = [];

        foreach ($fieldDefinitions as $fieldName => $fieldDef) {
            $value = isset($formValues[$fieldName]) ? $formValues[$fieldName] : null;
            list($validators) = $fieldDef;
            if ($validators) {
                if(is_string($validators)) {
                    $validators = preg_split('/\s*,\s*/', $validators);
                }
                list($fieldValid, $errorMessage) = $this->validateField($formValues, $fieldName, $value, $validators);
                if (!$fieldValid) {
                    $allValid           = false;
                    $errors[$fieldName] = $errorMessage;
                }
            }
        }

        return [$allValid, $errors];
    }

    private function validateField($formValues, $fieldName, $value, $validators) {
        $fieldValid   = true;
        $errorMessage = null;

        foreach ($validators as $validatorInfo) {
            list($validator, $validatorArgs) = Utils::parseValidator($validatorInfo);

            if (is_callable($validator)) {
                list($succeed, $errorMessage) = call_user_func($validator, $fieldName, $value, $formValues, $validatorArgs);
            } elseif ($validator instanceOf ValidatorInterface) {
                list($succeed, $errorMessage) = $validator->validate($fieldName, $value, $formValues);
            } else {
                throw new \InvalidArgumentException("Validator Info is invalid: {$validatorInfo}");
            }

            if (!$succeed) {
                $fieldValid = false;
                break;
            }
        }

        return [$fieldValid, $errorMessage];
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
