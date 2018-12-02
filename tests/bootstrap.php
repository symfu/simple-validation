<?php
/**
 * In order to run these unit tests, you need to install the required packages using Composer:
 *
 *    $ composer install
 *
 * After that you can run the tests by invoking the local PHPUnit
 *
 * To run all test simply use:
 *
 *    $ vendor/bin/phpunit
 *
 * Or run a single test file by specifying its path:
 *
 *    $ vendor/bin/phpunit test/InflectorTest.php
 *
 **/
echo "Bootstrapping Test Environment......\n";

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/Helper/SimpleRecordTestCase.php';
require_once __DIR__ . '/Helper/DatabaseTest.php';
require_once __DIR__ . '/Helper/AdapterTest.php';


error_reporting(E_ALL | E_STRICT);

