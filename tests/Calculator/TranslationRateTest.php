<?php

namespace Kenjis\TranslationTools\Calculator;

class TranslationRateTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var TranslationRate
     */
    protected $obj;

    protected function setUp()
    {
        parent::setUp();
        $this->obj = new TranslationRate($docs_en);
    }

    public function testNew()
    {
        $this->assertInstanceOf('\Kenjis\TranslationTools\Calculator\TranslationRate', $this->obj);
    }

    public function getLineArray($string)
    {
        $newlines = [];
        $lines = explode("\n", $string);
        foreach ($lines as $line) {
            $newlines[] = $line . "\n";
        }
        
        return $newlines;
    }

    public function testCalc_no_translation()
    {
        $en = <<<'EOL'
Chapter 1 Title
===============

EOL;
        $ja = <<<'EOL'
Chapter 1 Title
===============

EOL;
        $lines_en = $this->getLineArray($en);
        $lines_ja = $this->getLineArray($ja);

        $test = $this->obj->calc($lines_en, $lines_ja);
        $this->assertEquals(0, $test);
    }

    public function testCalc_translation_completed()
    {
        $en = <<<'EOL'
Chapter 1 Title
===============

EOL;
        $ja = <<<'EOL'
Chapter 1 タイトル
=================

EOL;
        $lines_en = $this->getLineArray($en);
        $lines_ja = $this->getLineArray($ja);

        $test = $this->obj->calc($lines_en, $lines_ja);
        $this->assertEquals(100, $test);
    }

     public function testCalc_complex_case()
    {
        $lines_en = file(__DIR__ . '/../Fixture/translation_rate/news_section.en.rst');
        $lines_ja = file(__DIR__ . '/../Fixture/translation_rate/news_section.ja.rst');

        $test = round($this->obj->calc($lines_en, $lines_ja), 3);
        $this->assertEquals(23.077, $test, 0.0001);
    }
}
