<?php

namespace GetPayPHP\Tests\Transformers;

use PHPUnit\Framework\TestCase;
use GetPayPHP\Transformers\Collection;

class CollectionTest extends TestCase
{
    public function setUp()
    {
        $this->collection = new Collection([
            '2019-01-01',
            4,
            'natural',
            'cash_in',
            1200.00,
            'EUR',
        ]);
    }

    public function testMagicMethodCall()
    {
        $this->assertNull($this->collection->methodDoesNotExists());
    }
}
