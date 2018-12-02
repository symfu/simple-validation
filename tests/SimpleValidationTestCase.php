<?php
namespace Symfu\SimpleValidation\Test;

class SimpleValidationTestCase extends \PHPUnit\Framework\TestCase
{
    public function setUp()
    {
        if(function_exists('mb_internal_encoding'))
        {
            mb_internal_encoding("UTF-8");
        }
    }
}
