<?php
namespace Symfu\SimpleValidation\Validator;

use Symfu\SimpleValidation\ValidatorInterface;

class RegexValidator implements ValidatorInterface {
    const message = 'simple_validation.errors.regex';

    protected $pattern   = '';
    protected $jsPattern = '';

    public function __construct($arg = null) {
        if($arg) {
            $this->setArgument($arg);
        }
    }

    public function validate($fieldName, $value, $formValues = []) {
        if (is_string($value) && strlen($value) < 1) {
            return [true, ''];
        }

        if (strlen($value) > 0 && !preg_match($this->pattern, $value)) {
            return [false, static::message];
        }

        return [true, ''];
    }

    public function toJQueryValidateRule() {
        $jsPattern = $this->jsPattern;

        if (strlen($jsPattern) < 1) {
            return null;
        }

        return ['regex' => $jsPattern];
    }

    public function setArgument($pattern) {
        if (strlen($pattern) < 1) {
            throw new \InvalidArgumentException("Invalid argument for " . static::class);
        }

        $this->pattern   = $pattern;
        $this->jsPattern = $pattern;
    }
}
