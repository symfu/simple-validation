<?php
namespace Symfu\SimpleValidation\Test\Validators;

use Symfu\SimpleValidation\Constants;
use Symfu\SimpleValidation\Registry;
use Symfu\SimpleValidation\ValidatorManager;

class ValidatorTest extends \PHPUnit_Framework_TestCase
{
    /** @var  ValidatorManager */
    var $validatorManager;
    public function setUp()
    {
        $this->validatorManager = new ValidatorManager();
    }

    public function testRegister()
    {
        $registry = Registry::getRegistry(Constants::CUSTOM_VALIDATORS);

        $this->assertFalse($registry->has('non-existance-key'));

        $this->validatorManager->register('custom_validator_1', function($value){return true;});

        $this->assertTrue($registry->has('custom_validator_1'));
        $this->assertTrue(is_callable($registry->get('custom_validator_1')));
    }

    public function testValidate()
    {
        $fieldDefs  = array(
            'username'  => array(preg_split('/\s*,\s*/', 'required, alpha, min_length[5], max_length[20]'), null),
            'nickname'  => array(preg_split('/\s*,\s*/', 'required, alpha, min_length[5], max_length[20]'), null),
            'first_name' => array(preg_split('/\s*,\s*/', 'required, alpha, min_length[5], max_length[20]'), null),
            'last_name'  => array(preg_split('/\s*,\s*/', 'required, alpha, min_length[5], max_length[20]'), null),
            'email'     => array(preg_split('/\s*,\s*/', 'required, email'), null),
            'password1' => array(preg_split('/\s*,\s*/', 'required, min_length[6], max_length[100]'), null),
            'password2' => array(preg_split('/\s*,\s*/', 'required, min_length[6], max_length[100], matches[password1]'), null),
        );

        // valid
        $formValues = array(
            'username'  => 'symfu',
            'nickname'  => 'Symfu',
            'first_name' => 'Yi',
            'last_name'  => 'Liang',
            'email'     => 'LY@edge.ac',
            'password1' => 'abc123456',
            'password2' => 'abc123456',
        );

        list($valid, $errors) = $this->validatorManager->validate($formValues, $fieldDefs);
        $this->assertTrue($valid);
        $this->assertEmpty($errors);

        // invalid
        $formValues = array(
            'username'  => '',
            'nickname'  => 'invalid_name!',
            'first_name' => 'Lia',
            'last_name'  => 'thisnameistoolooooooooong',
            'email'     => 'thisisa*invalid@gmail.com',
            'password1' => 'abc123456',
            'password2' => 'qwertyuio',
        );

        list($valid, $errors) = $this->validatorManager->validate($formValues, $fieldDefs);
        $this->assertFalse($valid);
        $this->assertEquals('simple_validation.errors.required',    $errors['username']);
        $this->assertEquals('simple_validation.errors.alpha',       $errors['nickname']);
        $this->assertEquals('simple_validation.errors.min_length',  $errors['first_name']);
        $this->assertEquals('simple_validation.errors.max_length',  $errors['last_name']);
        $this->assertEquals('simple_validation.errors.email', $errors['email']);
        $this->assertEquals('simple_validation.errors.matches',     $errors['password2']);
    }
}
