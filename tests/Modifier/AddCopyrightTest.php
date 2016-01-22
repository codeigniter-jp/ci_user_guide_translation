<?php

namespace Kenjis\TranslationTools\Modifier;

use Kenjis\TranslationTools\File;

class AddCopyrightTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AddCopyright
     */
    protected $obj;

    protected function setUp()
    {
        parent::setUp();
        $this->obj = new AddCopyright();
    }

    public function testNew()
    {
        $this->assertInstanceOf('\Kenjis\TranslationTools\Modifier\AddCopyright', $this->obj);
    }

    public function testAdd()
    {
        $html = new File(__DIR__ . '/../Fixture/html/copyright.html');
        $html->setName('html/test.html');
        
        $this->expectOutputString('Added Copyright link: html/test.html'.PHP_EOL);
        $test = $this->obj->add($html);
        
        $expected = <<<'EOL'
<!DOCTYPE html>
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <hr/>
        <div>TODO write content</div>

  <div role="contentinfo">
    <p>
        &copy; Copyright 2014 - 2016, British Columbia Institute of Technology.
      最終更新: Jan 22, 2016<br />Japanese Translation: <a href="http://codeigniter.jp/">CodeIgniter Users Group in Japan</a>
    </p>
  </div>
    </body>
</html>

EOL;
        $this->assertEquals($expected, $test);
    }

    public function testAdd_do_not_add_when_already_added()
    {
        $html = new File(__DIR__ . '/../Fixture/html/copyright_added.html');
        $html->setName('html/test.html');
        
        $test = $this->obj->add($html);
        
        $expected = <<<'EOL'
<!DOCTYPE html>
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <hr/>
        <div>TODO write content</div>

  <div role="contentinfo">
    <p>
        &copy; Copyright 2014 - 2016, British Columbia Institute of Technology.
      最終更新: Jan 22, 2016<br />Japanese Translation: <a href="http://codeigniter.jp/">CodeIgniter Users Group in Japan</a>
    </p>
  </div>
    </body>
</html>

EOL;
        $this->assertEquals($expected, $test);
    }
}
