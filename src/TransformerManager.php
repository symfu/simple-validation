<?php
namespace Symfu\SimpleValidation;

class TransformerManager implements TransformerManagerInterface {
    public function register($transformerName, TransformerInterface $instance) {
        $registry = Registry::getRegistry(Constants::CUSTOM_TRANSFORMERS);
        $registry->set($transformerName, $instance);
    }

    public function transform($direction, $formValues, $fieldDefinitions) {
        foreach ($fieldDefinitions as $fieldName => $fieldDef) {
            list($validators, $defaultValue, $transformers) = $fieldDef;
            $value = isset($formValues[$fieldName]) ? $formValues[$fieldName] : $defaultValue;
            if ($transformers) {
                $formValues[$fieldName] = $this->transformField($transformers, $value, $fieldName, $formValues, $direction);
            }
        }

        return $formValues;
    }

    private function transformField($direction, $transformers, $value, $fieldName, $formValues) {
        foreach ($transformers as $transformerLiteral) {
            list($transformerName, $arguments) = Utils::parseLiteral($transformerLiteral);
            $transformer = $this->loadTransformer($transformerName);

            if ($transformer instanceOf TransformerInterface) {
                $value = $transformer->transform($direction, $value, $arguments, $fieldName, $formValues);
            } elseif (is_callable($transformer)) {
                $args = [$direction, $value, $arguments ?: null, $fieldName, $formValues];
                $value = call_user_func_array($transformer, $args);
            } else {
                throw new \InvalidArgumentException("Processor Info is invalid: {$transformerLiteral}");
            }
        }

        return $value;
    }

    protected function loadTransformer($transformerName) {
        if ($transformerName instanceof TransformerInterface) {
            return $transformerName;
        }

        $cachedTransformers = Registry::getRegistry(Constants::TRANSFORMER_INSTANCES);
        $customTransformers = Registry::getRegistry(Constants::CUSTOM_TRANSFORMERS);

        $transformer = self::getInstance($transformerName, $cachedTransformers, $customTransformers);

        return $transformer;
    }

    // do some dirty works here
    private static function getInstance($objectName, Registry $instanceRegistry, Registry $customRegistry) {
        if ($instanceRegistry->has($objectName)) {
            $cachedInstance = $instanceRegistry->get($objectName);
            return $cachedInstance;
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
