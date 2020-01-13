<?php

use GetPayPHP\Application;
use GetPayPHP\Parsers\Csv;
use GetPayPHP\Services\Commission;
use GetPayPHP\Services\CurrencyExchange;
use GetPayPHP\Services\Operators\CashIn;
use GetPayPHP\Services\Operators\CashOutPartOne;

require __DIR__ . '/bootstrap.php';

$commission = new Commission();

$commission->setOperators([
    'cash_in'  => CashIn::class,
    'cash_out' => CashOutPartOne::class,
]);
$commission->setCurrencyExchange(new CurrencyExchange());

$collections = Application::make()
    ->setCommission($commission)
    ->setData(new Csv(__DIR__ . '/tests/inputPart1.csv'))
    ->handle();

require __DIR__ . '/printer.php';
