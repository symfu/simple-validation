<?php
namespace Symfu\SimpleValidation;

interface TransformerInterface {
    const TRANSFORM_IN  = 'IN';
    const TRANSFORM_OUT = 'OUT';
    
    public function transform($direction, $value, $args = null, $formValues = []);
}
