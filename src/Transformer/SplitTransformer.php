<?php
namespace Symfu\SimpleValidation\Transformer;

use Symfu\SimpleValidation\TransformerInterface;

class SplitTransformer implements TransformerInterface {
    public function transform($direction, $value, $args = null, $fieldName = null, $formValues = []) {
        if($direction === TransformerInterface::TRANSFORM_IN) {
            $quoted = preg_quote($args);
            $pattern = "/(?<!\[){$quoted}(?<!\])/";
            return preg_split($pattern, $value);
        } else {
            return join($args, $value);
        }

    }
}
