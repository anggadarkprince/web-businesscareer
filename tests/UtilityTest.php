<?php

require_once('models/Utility.class.php');

/**
 * Created by PhpStorm.
 * User: Angga
 * Date: 12/06/2016
 * Time: 09.00
 */
class UtilityTest extends PHPUnit_Framework_TestCase
{
    private $utility;

    public function setUp()
    {
        $this->utility = new Utility();
    }

    public function tearDown()
    {
        $this->utility = null;
    }

    public function testPre_params()
    {
        $this->assertEquals(":variables", $this->utility->pre_params("variables"));
    }

    public function testDate()
    {
        $this->assertEquals("2016-06-12", $this->utility->date());
    }

    public function testEncrypt()
    {
        $this->assertEquals("8479c86c7afcb56631104f5ce5d6de62", $this->utility->encrypt("angga"));
    }

    public function testThousandsCurrencyFormat()
    {
        $this->assertEquals("1K", $this->utility->thousandsCurrencyFormat(1000));
        $this->assertEquals("3.7K", $this->utility->thousandsCurrencyFormat(3700));
        $this->assertEquals("20K", $this->utility->thousandsCurrencyFormat(20000));
        $this->assertEquals("25.3K", $this->utility->thousandsCurrencyFormat(25300));
        $this->assertEquals("2.5K", $this->utility->thousandsCurrencyFormat(2530));

        $this->assertEquals("1M", $this->utility->thousandsCurrencyFormat(1000000));
        $this->assertEquals("3.7M", $this->utility->thousandsCurrencyFormat(3700000));
        $this->assertEquals("20M", $this->utility->thousandsCurrencyFormat(20000000));
        $this->assertEquals("25.3M", $this->utility->thousandsCurrencyFormat(25300000));

        $this->assertEquals("1B", $this->utility->thousandsCurrencyFormat(1000000000));
        $this->assertEquals("3.7B", $this->utility->thousandsCurrencyFormat(3700000000));
        $this->assertEquals("20B", $this->utility->thousandsCurrencyFormat(20000000000));
        $this->assertEquals("25.3B", $this->utility->thousandsCurrencyFormat(25300000000));

        $this->assertEquals("1T", $this->utility->thousandsCurrencyFormat(1000000000000));
        $this->assertEquals("3.7T", $this->utility->thousandsCurrencyFormat(3700000000000));
        $this->assertEquals("20T", $this->utility->thousandsCurrencyFormat(20000000000000));
        $this->assertEquals("25.3T", $this->utility->thousandsCurrencyFormat(25300000000000));
    }

    public function testFormat_currency()
    {
        $this->assertEquals("1.000,00", $this->utility->format_currency(1000, 2, ",", "."));
        $this->assertEquals("1.500", $this->utility->format_currency(1500, 0, ",", "."));
        $this->assertEquals("1.000.000.0", $this->utility->format_currency(1000000, 1, ".", "."));
    }
}
