<?php
namespace Symfu\SimpleValidation\Transformer;

use Symfu\SimpleValidation\TransformerInterface;

class SplitTransformer implements TransformerInterface {
    public function transform($direction, $value, $args = null, $fieldName = null, $formValues = []) {
        if($direction === TransformerInterface::TRANSFORM_IN) {
            return preg_split("/{$args}/", $value);
        } else {
            return join($args, $value);
        }

    }
}
