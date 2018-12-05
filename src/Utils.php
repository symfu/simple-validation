<?php
namespace Symfu\SimpleValidation;

class Utils {
    public static function parseValidator($literal) {
        if ($literal instanceof ValidatorInterface) {
            return [$literal, null];
        }

        list($objectName, $arguments) = self::parseLiteral($literal);

        $cachedValidators = Registry::getRegistry(Constants::VALIDATOR_INSTANCES);
        $customValidators = Registry::getRegistry(Constants::CUSTOM_VALIDATORS);

        $validator = self::getInstance($objectName, $cachedValidators, $customValidators);
        return [$validator, $arguments];
    }

    public static function parseTransformer($literal) {
        if ($literal instanceof TransformerInterface) {
            return [$literal, null];
        }

        list($objectName, $arguments) = self::parseLiteral($literal);

        $cachedTransformers = Registry::getRegistry(Constants::TRANSFORMER_INSTANCES);
        $customTransformers = Registry::getRegistry(Constants::CUSTOM_TRANSFORMERS);

        $validator = self::getInstance($objectName, $cachedTransformers, $customTransformers);
        return [$validator, $arguments];
    }

    private static function parseLiteral($literal) {
        static $pattern = '/^([a-z0-9_-]+)\[(.+?)\]$/i';

        $literal = trim($literal);
        if (preg_match($pattern, $literal, $matches)) {
            $name = $matches[1];
            $args = $matches[2];
        } else {
            $name = $literal;
            $args = null;
        }

        return [$name, $args === null ? null : trim($args)];
    }

    // do some dirty works here
    private static function getInstance($objectName, Registry $instanceRegistry, Registry $customRegistry) {
        if ($instanceRegistry->has($objectName)) {
            $cachedInstance = $instanceRegistry->get($objectName);
            return $cachedInstance;
        }

        $builtinValidatorKey = "simple_validation.validator.{$objectName}.class";
        $customValidatorKey  = "simple_validation.validator.custom.{$objectName}.class";
        $validatorClass = isset(Constants::$builtinValidators[$builtinValidatorKey]) ? Constants::$builtinValidators[$builtinValidatorKey] : $customRegistry->get($customValidatorKey);
        if ($validatorClass) {
            $validatorInstance = new $validatorClass();
            $instanceRegistry->set($objectName, $validatorInstance);

            return $validatorInstance;
        }

        $builtinTransformerKey = "simple_validation.transformer.{$objectName}.class";
        $customTransformerKey  = "simple_validation.transformer.custom.{$objectName}.class";
        $transformerClass = isset(Constants::$builtinTransformers[$builtinTransformerKey]) ? Constants::$builtinTransformers[$builtinTransformerKey] : $customRegistry->get($customTransformerKey);
        if ($transformerClass) {
            $transformerInstance = new $transformerClass();
            $instanceRegistry->set($objectName, $transformerInstance);

            return $transformerInstance;
        }

        if (is_callable($objectName)) {
            return $objectName;
        }

        return null;
    }
}
