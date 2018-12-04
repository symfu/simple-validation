<?php
namespace Symfu\SimpleValidation\Transformer;

use Symfu\SimpleValidation\TransformerInterface;

class SplitTransformer implements TransformerInterface {
    public function transform($value, $args = null, $formValues = []) {
        return preg_split("/{$args}/", $value);
    }
}
