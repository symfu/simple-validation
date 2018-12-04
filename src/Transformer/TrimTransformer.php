<?php
namespace Symfu\SimpleValidation\Transformer;

use Symfu\SimpleValidation\TransformerInterface;

class TrimTransformer implements TransformerInterface {
    public function transform($value, $args = null, $formValues = []) {
        return trim($value);
    }
}
