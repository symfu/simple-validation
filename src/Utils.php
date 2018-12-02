<?php

namespace Symfu\SimpleValidation\Helper;

use Symfu\SimpleValidation\Constants;
use Symfu\SimpleValidation\Registry;
use Symfu\SimpleValidation\ValidatorInterface;
use Symfu\SimpleValidation\Validators;

class Utils {
    public static function parseValidator($valicatorInfo) {
        $cachedValidators = Registry::getRegistry(Constants::VALIDATOR_INSTANCES);
        $cachedArgs       = Registry::getRegistry(Constants::VALIDATOR_INSTANCE_ARGS);
        $customValidators = Registry::getRegistry(Constants::CUSTOM_VALIDATORS);

        if($valicatorInfo instanceof ValidatorInterface) {
            return [$valicatorInfo, null];
        }

        return self::getCachedInstance($valicatorInfo, $cachedValidators, $cachedArgs, $customValidators, 'validators');
    }

    public static function parseProcessor($processorInfo) {
        $cachedProcessors = Registry::getRegistry(Constants::PROCESSOR_INSTANCES);
        $cachedArgs       = Registry::getRegistry(Constants::PROCESSOR_INSTANCE_ARGS);
        $customProcessors = Registry::getRegistry(Constants::CUSTOM_PROCESSORS);

        return self::getCachedInstance($processorInfo, $cachedProcessors, $cachedArgs, $customProcessors, 'processors');
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

        return [$name, trim($args)];
    }

    // do some dirty works here
    private static function getCachedInstance($info, Registry $cachedInctances, Registry $cachedArgs, Registry $customInstances, $serviceCatetory) {
        if ($cachedInctances->has($info)) {
            $cachedObject = $cachedInctances->get($info);
            $args         = $cachedArgs->get($info);

            return [$cachedObject, $args];
        }

        list($objectName, $args) = self::parseInfo($info);

        if ($customInstances->has($info)) {
            $customObject = $customInstances->get($info);
            if($customObject instanceof ValidatorInterface && $args) {
                $customObject->setArgs($args);
            }
            $cachedInctances->set($info, $customObject);
            $cachedArgs->set($info, $args);

            return [$customObject, $args];
        }

        $instance                   = null;
        $buildinObjectFqcnParameter = "simple_form.{$serviceCatetory}.buildins.{$objectName}.class";
        $customObjectFqcnParameter  = "simple_form.{$serviceCatetory}.custom.{$objectName}.class";

        if (isset(Validators::$buildinValidators[$buildinObjectFqcnParameter])) {
            $processorFQCN = Validators::$buildinValidators[$buildinObjectFqcnParameter];
            $instance      = new $processorFQCN();
            if($args) {
                $instance->setArgs($args);
            }
        } elseif (isset(Validators::$buildinValidators[$customObjectFqcnParameter])) {
            $processorFQCN = Validators::$buildinValidators[$customObjectFqcnParameter];
            $instance      = new $processorFQCN($args);
        }

        if ($instance) {
            $cachedInctances->set($info, $instance);
            $cachedArgs->set($info, $args);
            return [$instance, $args];
        }

        if (is_callable($info)) {
            return [$info, null];
        }

        return [null, null];
    }
}
