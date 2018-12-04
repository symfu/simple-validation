<?php

namespace Symfu\SimpleValidation\Test\Validators;

use Symfu\SimpleValidation\Constants;
use Symfu\SimpleValidation\Registry;
use Symfu\SimpleValidation\Test\SimpleValidationTestCase;
use Symfu\SimpleValidation\ValidationManager;

class ValidationManagerTest extends SimpleValidationTestCase {
    /** @var  ValidationManager */
    var $validationManager;

    public function setUp() {
        $this->validationManager = new ValidationManager();
    }

    public function testRegister() {
        $registry = Registry::getRegistry(Constants::CUSTOM_VALIDATORS);

        $this->assertFalse($registry->has('non-existance-key'));

        $this->validationManager->register('custom_validator_1', function ($value) { return true; });

        $this->assertTrue($registry->has('custom_validator_1'));
        $this->assertTrue(is_callable($registry->get('custom_validator_1')));
    }

    public function testValidate() {
        $fieldDefs = [
            'username'   => ['required, alpha, min_length[5], max_length[20]'],
            'nickname'   => ['required, alpha, min_length[5], max_length[20]'],
            'first_name' => ['required, alpha, min_length[2], max_length[20]'],
            'last_name'  => ['required, alpha, min_length[2], max_length[20]'],
            'email'      => ['required, email'],
            'password1'  => ['required, min_length[6], max_length[100]'],
            'password2'  => ['required, min_length[6], max_length[100], equals_to[password1]'],
        ];

        // valid
        $formValues = [
            'username'   => 'symfu',
            'nickname'   => 'Symfu',
            'first_name' => 'Yi',
            'last_name'  => 'Liang',
            'email'      => 'LY@edge.ac',
            'password1'  => 'abc123456',
            'password2'  => 'abc123456',
        ];

        list($valid, $errors) = $this->validationManager->validate($formValues, $fieldDefs);
        $this->assertTrue($valid);
        $this->assertEmpty($errors);

        // invalid
        $formValues = [
            'username'   => '',
            'nickname'   => 'invalid_name!',
            'first_name' => 'L',
            'last_name'  => 'thisnameistoolooooooooong',
            'email'      => 'thisisa*invalid@gmail.com',
            'password1'  => 'abc123456',
            'password2'  => 'qwertyuio',
        ];

        list($valid, $errors) = $this->validationManager->validate($formValues, $fieldDefs);
        $this->assertFalse($valid);
        $this->assertEquals('simple_validation.errors.required', $errors['username']);
        $this->assertEquals('simple_validation.errors.alpha', $errors['nickname']);
        $this->assertEquals('simple_validation.errors.min_length', $errors['first_name']);
        $this->assertEquals('simple_validation.errors.max_length', $errors['last_name']);
        $this->assertEquals('simple_validation.errors.email', $errors['email']);
        $this->assertEquals('simple_validation.errors.equals_to', $errors['password2']);
    }
}
