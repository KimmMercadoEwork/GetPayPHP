<?php

namespace GetPayPHP\Tests\Parsers;

use PHPUnit\Framework\TestCase;
use GetPayPHP\Parsers\Csv;
use GetPayPHP\Transformers\Collection;
use GetPayPHP\Exceptions\WrongFileExtension;

class CsvTest extends TestCase
{
    public function testCsvCollection()
    {
        $arr = new Csv(__DIR__.'/../inputPart1.csv');

        $collections = $arr->collections();

        $this->assertInstanceOf(Collection::class, $collections[0]);
        $this->assertEquals($collections[0]->date(), '2014-12-31');
        $this->assertEquals($collections[0]->userId(), '4');
        $this->assertEquals($collections[0]->userType(), 'natural');
        $this->assertEquals($collections[0]->transactionType(), 'cash_out');
        $this->assertEquals($collections[0]->amount(), '1200.00');
        $this->assertEquals($collections[0]->currency(), 'EUR');
    }
}
