<?php
namespace Breadlesscode\Office\Test;

use Breadlesscode\Office\File;

class FileTest extends TestCase
{
    /**
     * @test
     */
    public function canAccessTestFile()
    {
        $file = new File($this->getTestFile('Test.odt'));
        self::assertInstanceOf(File::class, $file);
    }

    /**
     * @test
     * @expectedException \Exception
     */
    public function detectNonExistingTestFile()
    {
        new File($this->getTestFile('test'));
        self::expectException(\Exception::class);
    }
}
