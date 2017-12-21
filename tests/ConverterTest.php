<?php

namespace Breadlesscode\Office\Test;

use Breadlesscode\Office\Converter;

class ConverterTest extends TestCase
{
    /**
     * @test
     * @expectedException \Breadlesscode\Office\Exception\ConverterException
     */
    public function converterCanDetectUnsupportedExtension()
    {
        self::assertFalse(Converter::canHandleExtension('php'));

        Converter::file($this->getTestFile('Test.php'));
        self::expectException(\Breadlesscode\Office\Exception\ConverterException::class);
    }

    /**
     * @test
     */
    public function converterCanConvertOdtFile()
    {
        $fileConverter = Converter::file($this->getTestFile('Test.odt'));
        self::assertTrue(Converter::canHandleExtension('odt'));
        self::assertInstanceOf(Converter::class, $fileConverter);
    }

    /**
     * @test
     */
    public function canGenerateThumbnail()
    {
        Converter::file($this->getTestFile('Test.odt'))
            ->thumbnail();

        $this->assertFileExists($this->getTestFileDirectory() . '/Test.jpg');
    }

    /**
     * @test
     */
    public function canGeneratePdfVersion()
    {
        Converter::file($this->getTestFile('Test.odt'))
            ->save('MyTest.pdf');

        $this->assertFileExists($this->getTestFileDirectory() . '/Test.jpg');
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
