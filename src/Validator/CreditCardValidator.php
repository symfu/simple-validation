<?php
namespace Symfu\SimpleValidation\Validator;

class CreditCardValidator extends RegexValidator {
    const message = 'validation.errors.credit_card';
    const PATTERN = '/^\d{4}\s*\d{4}\s*\d{4}\s*\d{4}$/i';

    public function validate($value, $argument = null, $fieldName = null, $formValues = []) {
        $value = trim($value);
        list($valid, $error) = parent::validate($value, self::PATTERN, $fieldName, $formValues);
        if (!$valid) {
            return [false, self::message];
        }

        $valid = $this->luhnCheck($value);
        return $valid ? [true, null] : [false, self::message];
    }

    private function luhnCheck($number) {
        // Strip any non-digits (useful for credit card numbers with spaces and hyphens)
        $number = preg_replace('/\D/', '', $number);

        // Set the string length and parity
        $len = strlen($number);
        $parity = $len % 2;

        // Loop through each digit and do the maths
        $total = 0;
        for ($i = 0; $i < $len; $i++) {
            $digit = $number[$i];
            // Multiply alternate digits by two
            if ($i % 2 == $parity) {
                $digit *= 2;
                // If the sum is two digits, add them together (in effect)
                if ($digit > 9) {
                    $digit -= 9;
                }
            }
            // Total up the digits
            $total += $digit;
        }

        // If the total mod 10 equals 0, the number is valid
        return $total % 10 === 0;

    }

    public function toJQueryValidateRule($argument) {
        return parent::toJQueryValidateRule(self::PATTERN);
    }
}
