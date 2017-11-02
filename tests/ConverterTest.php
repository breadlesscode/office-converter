<?php
namespace Breadlesscode\Office\Test;

use Breadlesscode\Office\Converter;

class ConverterTest extends TestCase
{
    /** @test */
    public function it_can_gernerate_thumbnail()
    {
        Converter::file($this->getTestFile('Test.odt'))
            ->thumbnail();

        $this->assertFileExists($this->getTestFileDirectory().'/Test.jpg');
    }

    /** @test */
    public function it_can_gernerate_a_pdf_version()
    {
        Converter::file($this->getTestFile('Test.odt'))
            ->save('MyTest.pdf');

        $this->assertFileExists($this->getTestFileDirectory().'/Test.jpg');
    }

    /** @test */
    public function it_can_export_text()
    {
        $text = Converter::file($this->getTestFile('Test.odt'))
            ->text();

        $this->assertEquals('DEMO', $text);
    }
}
