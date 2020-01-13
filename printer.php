<?php

$table = new LucidFrame\Console\ConsoleTable();
$table
    ->addHeader('Date')
    ->addHeader('ID')
    ->addHeader('User')
    ->addHeader('Transaction')
    ->addHeader('Amount')
    ->addHeader('Currency')
    ->addHeader('Fee')
    ->addHeader('Fee (Rounded Up)')
    ->addHeader('Fee (EUR)');

foreach ($collections as $collection) {
    $table->addRow()
        ->addColumn($collection->date())
        ->addColumn($collection->userId())
        ->addColumn($collection->userType())
        ->addColumn($collection->transactionType())
        ->addColumn($collection->amount())
        ->addColumn($collection->currency())
        ->addColumn($collection->getValue('rawFee'))
        ->addColumn($collection->getValue('roundUpFee'))
        ->addColumn($collection->getValue('convertedFee'));
}

echo sprintf("Load Time: %s\n", microtime(true) - START_TIME);
$table->display();
