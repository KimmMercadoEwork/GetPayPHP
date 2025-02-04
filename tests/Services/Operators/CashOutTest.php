<?php

namespace GetPayPHP\Tests\Services\Operators;

use GetPayPHP\Services\CurrencyExchange;
use GetPayPHP\Services\Operators\CashOutPartOne;
use GetPayPHP\Transformers\Collection;
use PHPUnit\Framework\TestCase;

class CashOutPartOneTest extends TestCase
{
    private function createInstance($datum)
    {
        $instance = new CashOutPartOne(new Collection($datum));

        $instance->setCurrencyExchange(new CurrencyExchange());

        return $instance;
    }

    public function testLegalPerson()
    {
        $instance = $this->createInstance([
            '2019-01-01',
            4,
            'legal',
            'cash_out',
            5000.00,
            'EUR',
        ]);

        // amount * (% commission fee / 100%)
        // 5000 * (0.3% / 100%)
        // 5000 * 0.003
        // should be 15
        $this->assertEquals($instance->fee(), '15.00');
    }

    public function testLegalPersonWithLegalLimit()
    {
        $instance = $this->createInstance([
            '2019-01-01',
            2,
            'legal',
            'cash_out',
            60,
            'JPY',
        ]);

        // JPY of 60 if we will convert it to EUR
        // 129.53 jpy = 1eur
        // 60/129.53 is just a 0.46 eur
        // based on the specs, no commission fee
        // for legal limit of 0.5 eur
        $this->assertEquals($instance->fee(), '0.00');
    }

}
