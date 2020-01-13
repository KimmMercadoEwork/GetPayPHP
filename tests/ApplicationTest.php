<?php

namespace GetPayPHP\Tests;

use GetPayPHP\Application;
use GetPayPHP\Parsers\Csv;
use PHPUnit\Framework\TestCase;
use GetPayPHP\Transformers\Collection;

class ApplicationTest extends TestCase
{
    public function testBootstrap()
    {
        $collections = Application::make()
            ->setData(new Csv(__DIR__ . '/inputPart1.csv'))
            ->handle();

        $this->assertTrue(is_array($collections));
        $this->assertInstanceOf(Collection::class, $collections[0]);
    }
}
