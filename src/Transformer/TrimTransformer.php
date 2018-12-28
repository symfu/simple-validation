<?php
namespace Symfu\SimpleValidation\Transformer;

use Symfu\SimpleValidation\TransformerInterface;

class TrimTransformer implements TransformerInterface {
    public function transform($direction, $value, $args = null, $formValues = []) {
        if($direction === TransformerInterface::TRANSFORM_IN) {
            return trim($value);
        } else {
            return $value;
        }
    }
}
