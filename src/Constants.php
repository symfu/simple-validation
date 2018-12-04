<?php
namespace Symfu\SimpleValidation;

class Constants
{
    const CUSTOM_VALIDATORS     = 'custom_validators';
    const CUSTOM_TRANSFORMERS   = 'custom_transformers';
    const VALIDATOR_INSTANCES   = 'validator_instances';
    const VALIDATOR_ARGS        = 'validator_args';
    const TRANSFORMER_INSTANCES = 'transformer_instances';
    const TRANSFORMER_ARGS      = 'transformer_args';

    static $builtinValidators = [
        'simple_validation.validator.alpha_dash.class'    => \Symfu\SimpleValidation\Validator\AlphaDashValidator::class,
        'simple_validation.validator.alpha_numeric.class' => \Symfu\SimpleValidation\Validator\AlphaNumValidator::class,
        'simple_validation.validator.alpha.class'         => \Symfu\SimpleValidation\Validator\AlphaValidator::class,
        'simple_validation.validator.base64.class'        => \Symfu\SimpleValidation\Validator\Base64Validator::class,
        'simple_validation.validator.decimal.class'       => \Symfu\SimpleValidation\Validator\DecimalValidator::class,
        'simple_validation.validator.digit.class'         => \Symfu\SimpleValidation\Validator\DigitValidator::class,
        'simple_validation.validator.date.class'          => \Symfu\SimpleValidation\Validator\DateValidator::class,
        'simple_validation.validator.date_time.class'     => \Symfu\SimpleValidation\Validator\DateTimeValidator::class,
        'simple_validation.validator.email.class'         => \Symfu\SimpleValidation\Validator\EmailValidator::class,
        'simple_validation.validator.enum.class'          => \Symfu\SimpleValidation\Validator\EnumValidator::class,
        'simple_validation.validator.equals_to.class'     => \Symfu\SimpleValidation\Validator\EqualsToValidator::class,
        'simple_validation.validator.exact_length.class'  => \Symfu\SimpleValidation\Validator\ExactLengthValidator::class,
        'simple_validation.validator.id_card.class'       => \Symfu\SimpleValidation\Validator\IdCardValidator::class,
        'simple_validation.validator.integer.class'       => \Symfu\SimpleValidation\Validator\IntegerValidator::class,
        'simple_validation.validator.min.class'           => \Symfu\SimpleValidation\Validator\MinValidator::class,
        'simple_validation.validator.max.class'           => \Symfu\SimpleValidation\Validator\MaxValidator::class,
        'simple_validation.validator.max_length.class'    => \Symfu\SimpleValidation\Validator\MaxLengthValidator::class,
        'simple_validation.validator.min_length.class'    => \Symfu\SimpleValidation\Validator\MinLengthValidator::class,
        'simple_validation.validator.mobile.class'        => \Symfu\SimpleValidation\Validator\MobileNumberValidator::class,
        'simple_validation.validator.numeric.class'       => \Symfu\SimpleValidation\Validator\NumericValidator::class,
        'simple_validation.validator.required.class'      => \Symfu\SimpleValidation\Validator\RequiredValidator::class,
        'simple_validation.validator.regex.class'         => \Symfu\SimpleValidation\Validator\RegexValidator::class,
    ];

    static $builtinTransformers = [
        'simple_validation.transformer.trim.class'    => \Symfu\SimpleValidation\Transformer\TrimTransformer::class,
        'simple_validation.transformer.split.class'   => \Symfu\SimpleValidation\Transformer\SplitTransformer::class,
    ];

}
