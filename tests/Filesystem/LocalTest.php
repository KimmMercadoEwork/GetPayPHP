<?php

namespace GetPayPHP\Tests\Filesystem;

use GetPayPHP\Filesystem\Local;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;

class LocalTest extends TestCase
{
    public function testFilesystem()
    {
        $fs = new Local;
        $fs->setPath($path = __DIR__ . '/../test.txt');

        $this->assertEquals($fs->getPath(), $path);
        $this->assertEquals($fs->getContents(), "Hello World!");
    }
}
