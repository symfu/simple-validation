<?php
namespace Symfu\SimpleValidation\Test;

use Symfu\SimpleValidation\ValidationError;

class SimpleValidationTestCase extends \PHPUnit\Framework\TestCase
{
    public function setUp()
    {
        if(function_exists('mb_internal_encoding'))
        {
            mb_internal_encoding("UTF-8");
        }
    }

    public function assertResultEquals($result, $expected) {
        /** @var ValidationError $validationError */
        list($valid,   $validationError) = $result;
        $this->assertEquals([$valid, $validationError->getMessageKey()], $expected);
    }
}
