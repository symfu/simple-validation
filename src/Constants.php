<?php
namespace Symfu\SimpleValidation;

class Constants
{
    const CUSTOM_VALIDATORS       = 'custom_validators';
    const VALIDATOR_INSTANCES     = 'validator_instances';
    const VALIDATOR_INSTANCE_ARGS = 'validator_instance_args';

    const SIMPLE_FORM_INTENTION   = 'simple_form';

    static $buildinValidators = [
        'simple_validation.validatorManager.alpha_dash.class'    => \Symfu\SimpleValidation\Validator\AlphaDashValidator::class,
        'simple_validation.validatorManager.alpha_numeric.class' => \Symfu\SimpleValidation\Validator\AlphaNumericValidator::class,
        'simple_validation.validatorManager.alpha.class'         => \Symfu\SimpleValidation\Validator\AlphaValidator::class,
        'simple_validation.validatorManager.base64.class'        => \Symfu\SimpleValidation\Validator\Base64Validator::class,
        'simple_validation.validatorManager.decimal.class'       => \Symfu\SimpleValidation\Validator\DecimalValidator::class,
        'simple_validation.validatorManager.digit.class'         => \Symfu\SimpleValidation\Validator\DigitValidator::class,
        'simple_validation.validatorManager.date.class'          => \Symfu\SimpleValidation\Validator\DateValidator::class,
        'simple_validation.validatorManager.date_time.class'     => \Symfu\SimpleValidation\Validator\DateTimeValidator::class,
        'simple_validation.validatorManager.email.class'         => \Symfu\SimpleValidation\Validator\EmailValidator::class,
        'simple_validation.validatorManager.enum.class'          => \Symfu\SimpleValidation\Validator\EnumValidator::class,
        'simple_validation.validatorManager.exact_length.class'  => \Symfu\SimpleValidation\Validator\ExactLengthValidator::class,
        'simple_validation.validatorManager.id_card.class'       => \Symfu\SimpleValidation\Validator\IdCardValidator::class,
        'simple_validation.validatorManager.integer.class'       => \Symfu\SimpleValidation\Validator\IntegerValidator::class,
        'simple_validation.validatorManager.natural.class'       => \Symfu\SimpleValidation\Validator\NaturalValidator::class,
        'simple_validation.validatorManager.min.class'           => \Symfu\SimpleValidation\Validator\MinValidator::class,
        'simple_validation.validatorManager.max.class'           => \Symfu\SimpleValidation\Validator\MaxValidator::class,
        'simple_validation.validatorManager.matches.class'       => \Symfu\SimpleValidation\Validator\MatchesValidator::class,
        'simple_validation.validatorManager.max_length.class'    => \Symfu\SimpleValidation\Validator\MaxLengthValidator::class,
        'simple_validation.validatorManager.min_length.class'    => \Symfu\SimpleValidation\Validator\MinLengthValidator::class,
        'simple_validation.validatorManager.mobile.class'        => \Symfu\SimpleValidation\Validator\MobileNumberValidator::class,
        'simple_validation.validatorManager.numeric.class'       => \Symfu\SimpleValidation\Validator\NumericValidator::class,
        'simple_validation.validatorManager.required.class'      => \Symfu\SimpleValidation\Validator\RequiredValidator::class,
        'simple_validation.validatorManager.regex.class'         => \Symfu\SimpleValidation\Validator\RegexValidator::class,
    ];

}
