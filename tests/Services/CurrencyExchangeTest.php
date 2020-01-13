<?php

namespace GetPayPHP\Tests\Services;

use GetPayPHP\Services\CurrencyExchange;
use PHPUnit\Framework\TestCase;
use GetPayPHP\Services\Math;

class CurrencyExchangeTest extends TestCase
{
    public function setUp()
    {
        $this->exchange = new CurrencyExchange();
    }

    public function testScenario()
    {
        $this->assertEquals(Math::roundUp($this->exchange->convert('EUR', 1)), 1);
        $this->assertEquals(Math::roundUp($this->exchange->convert('JPY', 129.53)), 1);
        $this->assertEquals(Math::roundUp($this->exchange->convert('USD', 1.1497)), 1);

        $this->assertEquals(Math::roundUp($this->exchange->convert('JPY', 100)), 0.78);
        $this->assertEquals(Math::roundUp($this->exchange->convert('USD', 100)), 86.98);
    }

    public function testUnsupportedCurrency()
    {
        try {
            $this->exchange->convert('PHP', 100);

            $this->assertTrue(false);
        } catch (\Throwable $e) {
            $this->assertEquals(
                $e->getMessage(),
                'We currently don\'t support [PHP] this type of currency.'
            );
        }
    }
}
