<?php
namespace Symfu\SimpleValidation\Validator;

class RegexValidator extends BaseValidator
{
    const message = 'simple_validation.errors.regex';

    protected $jsPattern = '';

    public function validate($fieldName, $value, $formValues = [])
    {
        if(is_string($value) && strlen($value) < 1)
        {
            return [true, ''];
        }

        $regex = trim($this->args);
        if(strlen($regex) < 1)
        {
            throw new \InvalidArgumentException("Invalid regex: {$regex}");
        }

        if(strlen($value) > 0 && !preg_match($regex, $value))
        {
            return [false, static::message];
        }

        return [true, ''];
    }

    public function toJQueryValidateRule()
    {
        $jsPattern = trim($this->jsPattern);

        if(strlen($jsPattern) < 1)
        {
            return null;
        }
//
//        $delimiter = $jsPattern[0];
//        $pos = stripos($jsPattern, $delimiter);
//        $pattern = substr($jsPattern, 0, $pos);
//        $modifiers = substr($jsPattern, $pos);

        return ['regex' => $jsPattern];
    }
}
