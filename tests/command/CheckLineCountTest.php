<?php

namespace Kenjis\TranslationTools\Command;

use Kenjis\TranslationTools\Document;

class CheckLineCountTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var CheckLineCount
     */
    protected $obj;

    protected function setUp()
    {
        parent::setUp();
        $this->obj = new CheckLineCount($docs_en);
    }

    public function testNew()
    {
        $this->assertInstanceOf('\Kenjis\TranslationTools\Command\CheckLineCount', $this->obj);
    }

    public function testCheck()
    {
        $docs_en = new Document(__DIR__ . '/../Fixture/docs_en');
        $docs_ja = new Document(__DIR__ . '/../Fixture/docs_ja');
        
         $this->expectOutputString('overview/mvc.rst : en 14 ja 16'.PHP_EOL);
        $this->obj->check($docs_en, $docs_ja);
    }
}
