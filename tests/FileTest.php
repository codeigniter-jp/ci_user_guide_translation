<?php

namespace Kenjis\TranslationTools;

class FileTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var File
     */
    protected $obj;

    public function testNew()
    {
        $actual = new File(__FILE__);
        $this->assertInstanceOf('\Kenjis\TranslationTools\File', $actual);
    }

    public function testGetLineCount()
    {
        $file = __DIR__ . '/Fixture/docs_en/index.rst';
        $obj = new File($file);
        $this->assertEquals(14, $obj->getLineCount());
    }
}
