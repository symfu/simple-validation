<?php
namespace Symfu\SimpleValidation;

class TransformerManager {
    public function register($transformerName, $instance) {
        $registry = Registry::getRegistry(Constants::CUSTOM_TRANSFORMERS);
        $registry->set($transformerName, $instance);
    }

    public function transform($formValues, $fieldDefinitions) {
        foreach ($fieldDefinitions as $fieldName => $fieldDef) {
            list($validators, $defaultValue, $transformers) = $fieldDef;
            $value = isset($formValues[$fieldName]) ? $formValues[$fieldName] : $defaultValue;
            if ($transformers) {
                $formValues[$fieldName] = $this->transformField($transformers, $value, $fieldName, $formValues);
            }
        }

        return $formValues;
    }

    private function transformField($transformers, $value, $fieldName, $formValues) {
        foreach ($transformers as $transformerLiteral) {
            list($transformer, $transformerArg) = Utils::parseTransformer($transformerLiteral);

            if ($transformer instanceOf TransformerInterface) {
                $value = $transformer->transform($value, $transformerArg, $formValues);
            } elseif (is_callable($transformer)) {
                $args = [$value];
                if($transformerArg !== null) {
                    array_push($args, $transformerArg);
                }
                $value = call_user_func_array($transformer, $args);
            } else {
                throw new \InvalidArgumentException("Processor Info is invalid: {$transformerLiteral}");
            }
        }

        return $value;
    }
}
