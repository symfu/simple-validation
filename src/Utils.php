<?php
namespace Symfu\SimpleValidation;

class Utils {
    public static function parseValidator($literal) {
        if ($literal instanceof ValidatorInterface) {
            return [$literal, null];
        }

        $cachedValidators = Registry::getRegistry(Constants::VALIDATOR_INSTANCES);
        $customValidators = Registry::getRegistry(Constants::CUSTOM_VALIDATORS);

        return self::getInstance($literal, $cachedValidators, $customValidators, 'validator');
    }

    public static function parseTransformer($literal) {
        if ($literal instanceof TransformerInterface) {
            return [$literal, null];
        }

        $cachedTransformers = Registry::getRegistry(Constants::TRANSFORMER_INSTANCES);
        $customTransformers = Registry::getRegistry(Constants::CUSTOM_TRANSFORMERS);

        return self::getInstance($literal, $cachedTransformers, $customTransformers, 'transformer');
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
    private static function getInstance($info, Registry $instanceRegistry, Registry $customRegistry, $category) {
        list($objectName, $objectArgs) = self::parseLiteral($info);

        if ($instanceRegistry->has($info)) {
            $cachedInstance = $instanceRegistry->get($info);
            return [$cachedInstance, $objectArgs];
        }

        if ($customRegistry->has($info)) {
            $customValidator = $customRegistry->get($info);
            return [$customValidator, $objectArgs];
        }

        $instance = null;
        if ($category === 'validator') {
            $key = "simple_validation.validator.{$objectName}.class";
            if (isset(Constants::$builtinValidators[$key])) {
                $class    = Constants::$builtinValidators[$key];
                $instance = new $class();
                if ($instance instanceof ValidatorInterface && $objectArgs !== null) {
                    $instance->setArgument($objectArgs);
                }
                $instanceRegistry->set($info, $instance);

                return [$instance, $objectArgs];
            }
        } elseif ($category === 'transformer') {
            $key = "simple_validation.transformer.{$objectName}.class";
            if (isset(Constants::$builtinTransformers[$key])) {
                $class    = Constants::$builtinTransformers[$key];
                $instance = new $class();
                $instanceRegistry->set($info, $instance);

                return [$instance, $objectArgs];
            }
        }

        if (is_callable($info)) {
            return [$info, null];
        }

        return [null, null];
    }
}
