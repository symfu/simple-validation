<?php
namespace Symfu\SimpleValidation\Test\Validators;

use Symfu\SimpleValidation\Registry;

class RegistryTest extends \PHPUnit\Framework\TestCase
{
    public function testGetRegistry()
    {
        // valid
        $reg1 = Registry::getRegistry();
        $reg2 = Registry::getRegistry('default');
        $this->assertSame($reg1, $reg2);

        $reg1 = Registry::getRegistry('one-registry');
        $reg2 = Registry::getRegistry('another-registry');
        $this->assertNotSame($reg1, $reg2);
    }
}
