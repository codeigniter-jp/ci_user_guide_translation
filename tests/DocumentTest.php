<?php

namespace Kenjis\TranslationTools;

class DocumentTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Document
     */
    protected $obj;

    protected function setUp()
    {
        parent::setUp();
        $this->docs_en = __DIR__ . '/Fixture/docs_en';
        $this->obj = new Document($this->docs_en, 'rst');
    }

    public function testNew()
    {
        $actual = $this->obj;
        $this->assertInstanceOf('\Kenjis\TranslationTools\Document', $actual);
    }

    public function testInit()
    {
        $expected = [
            'index.rst',
            'overview/index.rst',
            'overview/mvc.rst',
        ];
        $i = 0;
        foreach ($this->obj as $key => $val) {
            $this->assertEquals($expected[$i], $key);
            $i++;
        }
    }

    public function testGetFile()
    {
        $file = $this->obj->getFile('overview/mvc.rst');
        $this->assertEquals($this->docs_en.'/overview/mvc.rst', $file->getPathname());
    }
}
