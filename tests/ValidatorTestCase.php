<?php
namespace Symfu\SimpleValidation\Test;

class ValidatorTestCase extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        if(function_exists('mb_internal_encoding'))
        {
            mb_internal_encoding("UTF-8");
        }
    }
}
