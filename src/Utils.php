<?php
namespace Symfu\SimpleValidation;

class Utils {
    public static function parseLiteral($literal) {
        static $pattern = '/^([a-z0-9_-]+)\[(.+?)\]$/i';

        $literal = trim($literal);
        if (preg_match($pattern, $literal, $matches)) {
            $name = $matches[1];
            $args = $matches[2];
        } else {
            $name = $literal;
            $args = null;
        }

        return [$name, $args === null ? null : trim($args)];
    }
}
