<?php
namespace Symfu\SimpleValidation\Validator;

use Symfu\SimpleValidation\ValidatorInterface;

abstract class BaseValidator implements ValidatorInterface
{
    protected $args    = null;

    public function __construct($args = '') {
        $this->args = $args;
    }

    public function setArgs($args) {
        $this->args = trim($args);
    }

    public function toJQueryValidateRule()
    {
        return null;
    }
}
