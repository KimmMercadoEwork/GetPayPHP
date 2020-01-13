<?php

use GetPayPHP\Application;
use GetPayPHP\Parsers\Csv;
use GetPayPHP\Services\Commission;
use GetPayPHP\Services\CurrencyExchange;
use GetPayPHP\Services\Operators\CashIn;
use GetPayPHP\Services\Operators\CashOutPartOne;

require __DIR__ . '/bootstrap.php';

$collections = Application::make()
    ->setData(new Csv(__DIR__ . '/tests/inputPart2.csv'))
    ->handle();

require __DIR__ . '/printer.php';
