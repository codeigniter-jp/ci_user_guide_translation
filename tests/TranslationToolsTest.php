<?php

namespace Kenjis\TranslationTools;

class TranslationToolsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var TranslationTools
     */
    protected $skeleton;

    protected function setUp()
    {
        parent::setUp();
        $this->skeleton = new TranslationTools;
    }

    public function testNew()
    {
        $actual = $this->skeleton;
        $this->assertInstanceOf('\Kenjis\TranslationTools\TranslationTools', $actual);
    }

    public function testException()
    {
        $this->setExpectedException('\Kenjis\TranslationTools\Exception\LogicException');
        throw new Exception\LogicException;
    }
}
