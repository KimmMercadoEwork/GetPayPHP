<?php

namespace GetPayPHP\Tests\Services;

use GetPayPHP\Services\Commission;
use PHPUnit\Framework\TestCase;
use GetPayPHP\Transformers\Collection;
use GetPayPHP\Services\CurrencyExchange;
use GetPayPHP\Services\Operators\CashOutPartOne;
use GetPayPHP\Services\Operators\CashIn;

class CommissionTest extends TestCase
{
    public function testScenario()
    {
        $commission = new Commission();
        $commission->setCurrencyExchange(new CurrencyExchange());

        $amount = $commission->compute(new Collection([
            '2019-12-09',
            $userId = 1000,
            'legal',
            'cash_in',
            500,
            'EUR'
        ]));
        $this->assertEquals($amount, '0.15');

        $amount = $commission->compute(new Collection([
            '2019-12-09',
            $userId = 1000,
            'legal',
            'cash_out',
            300,
            'EUR'
        ]));
        $this->assertEquals($amount, '0.90');

        $amount = $commission->compute(new Collection([
            '2019-12-09',
            $userId = 1000,
            'natural',
            'cash_out',
            1100,
            'EUR'
        ]));
        $this->assertEquals($amount, '3.3000000000');
    }

    public function testSetOperators()
    {
        $commission = new Commission();
        $commission->setCurrencyExchange(new CurrencyExchange());
        $commission->setOperators([
            'cash_in' => CashIn::class,
            'cash_out' => CashOutPartOne::class,
        ]);


        // since this is the old Cash Out for natural
        // we should expect a 0.3% fee from the 900
        $amount = $commission->compute(new Collection([
            '2019-12-09',
            $userId = 1000,
            'natural',
            'cash_out',
            900,
            'EUR'
        ]));

        $this->assertEquals($amount, '2.70');
    }
}
