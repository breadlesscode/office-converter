<?php

namespace Breadlesscode\Office\Test;

use Breadlesscode\Office\Converter;

class ConverterTest extends TestCase
{
    /**
     * @test
     */
    public function canGenerateThumbnail()
    {
        Converter::file($this->getTestFile('Test.odt'))
            ->thumbnail();

        $this->assertFileExists($this->getTestFileDirectory().'/Test.jpg');
    }

    /**
     * @test
     */
    public function canGeneratePdfVersion()
    {
        Converter::file($this->getTestFile('Test.odt'))
            ->save('MyTest.pdf');

        $this->assertFileExists($this->getTestFileDirectory().'/Test.jpg');
    }

    /**
     * @test
     */
    public function canExportText()
    {
        $text = Converter::file($this->getTestFile('Test.odt'))
            ->text();

        $this->assertEquals('DEMO', $text);
    }
}
