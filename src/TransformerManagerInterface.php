<?php
namespace Symfu\SimpleValidation;

interface TransformerManagerInterface {
    public function register($transformerName, TransformerInterface $instance);

    public function transform($direction, $formValues, $fieldDefinitions);
}
