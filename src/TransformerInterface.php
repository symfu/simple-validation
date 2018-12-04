<?php
namespace Symfu\SimpleValidation;

interface TransformerInterface
{
    public function transform($value, $args = null, $formValues = array());
}
