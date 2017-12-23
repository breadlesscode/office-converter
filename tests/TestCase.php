<?php
namespace Breadlesscode\Office\Test;

use Spatie\TemporaryDirectory\TemporaryDirectory;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;

abstract class TestCase extends PHPUnitTestCase
{
    /**
     * @var \Spatie\TemporaryDirectory\TemporaryDirectory
     */
    protected $tempDir;

    public function setUp()
    {
        $this->tempDir = (new TemporaryDirectory(__DIR__))
            ->name('temp')
            ->force()
            ->create()
            ->empty();
    }

    protected function getTestFile($fileName): string
    {
        return $this->getTestFileDirectory().'/'.$fileName;
    }

    protected function getTestFileDirectory(): string
    {
        return __DIR__."/testfiles";
    }
}
