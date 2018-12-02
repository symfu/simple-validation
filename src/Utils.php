<?php
namespace Symfu\SimpleValidation;

class Utils {
    public static function parseValidator($valicatorInfo) {
        $cachedValidators = Registry::getRegistry(Constants::VALIDATOR_INSTANCES);
        $cachedArgs       = Registry::getRegistry(Constants::VALIDATOR_INSTANCE_ARGS);
        $customValidators = Registry::getRegistry(Constants::CUSTOM_VALIDATORS);

        if($valicatorInfo instanceof ValidatorInterface) {
            return [$valicatorInfo, null];
        }

        return self::getCachedInstance($valicatorInfo, $cachedValidators, $cachedArgs, $customValidators);
    }

    private static function parseInfo($info) {
        static $pattern = '/^([a-z0-9_-]+)\[(.+?)\]$/i';

        $info = trim($info);
        if (preg_match($pattern, $info, $matches)) {
            $name = $matches[1];
            $args = $matches[2];
        } else {
            $name = $info;
            $args = null;
        }

        return [$name, $args === null ? null : trim($args)];
    }

    // do some dirty works here
    private static function getCachedInstance($info, Registry $cachedInctances, Registry $cachedArgs, Registry $customValidators) {
        if ($cachedInctances->has($info)) {
            $cachedObject = $cachedInctances->get($info);
            $args         = $cachedArgs->get($info);

            return [$cachedObject, $args];
        }

        list($objectName, $args) = self::parseInfo($info);

        if ($customValidators->has($info)) {
            $customValidator = $customValidators->get($info);
            if($customValidator instanceof ValidatorInterface && $args) {
                $customValidator->setArgs($args);
            }
            $cachedInctances->set($info, $customValidator);
            $cachedArgs->set($info, $args);

            return [$customValidator, $args];
        }

        $validatorInstance     = null;
        $validatorKey = "simple_validation.validator.{$objectName}.class";

        if (isset(Constants::$buildinValidators[$validatorKey])) {
            $validatorClass    = Constants::$buildinValidators[$validatorKey];
            $validatorInstance = new $validatorClass();
            if($args !== null) {
                $validatorInstance->setArgs($args);
            }
        }

        if ($validatorInstance) {
            $cachedInctances->set($info, $validatorInstance);
            $cachedArgs->set($info, $args);
            return [$validatorInstance, $args];
        }

        if (is_callable($info)) {
            return [$info, null];
        }

        return [null, null];
    }
}
