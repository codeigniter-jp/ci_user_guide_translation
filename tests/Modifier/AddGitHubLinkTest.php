<?php

namespace Kenjis\TranslationTools\Modifier;

use Kenjis\TranslationTools\File;

class AddGitHubLinkTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AddGitHubLink
     */
    protected $obj;

    protected function setUp()
    {
        parent::setUp();
        $this->obj = new AddGitHubLink();
    }

    public function testNew()
    {
        $this->assertInstanceOf('\Kenjis\TranslationTools\Modifier\AddGitHubLink', $this->obj);
    }

    public function testAdd()
    {
        $html = new File(__DIR__ . '/../Fixture/html/test.html');
        $html->setName('html/test.html');
        
        $this->expectOutputString('Added: html/test.html'.PHP_EOL);
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
<div style="float:right;margin-left:5px;">[ <a href="https://github.com/bcit-ci/CodeIgniter/commits/develop/user_guide_src/source/html/test.rst">原文コミット履歴</a> | <a href="https://github.com/codeigniter-jp/user_guide_src_ja/commits/develop_japanese/source/html/test.rst">翻訳コミット履歴</a> | <a href="https://github.com/codeigniter-jp/user_guide_src_ja/blob/develop_japanese/source/html/test.rst">GitHubで修正</a> ]</div>
        <hr/>
        <div>TODO write content</div>
    </body>
</html>

EOL;
        $this->assertEquals($expected, $test);
    }

    public function testAdd_do_not_add_when_already_added()
    {
        $html = new File(__DIR__ . '/../Fixture/html/test.html');
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
<div style="float:right;margin-left:5px;">[ <a href="https://github.com/bcit-ci/CodeIgniter/commits/develop/user_guide_src/source/html/test.rst">原文コミット履歴</a> | <a href="https://github.com/codeigniter-jp/user_guide_src_ja/commits/develop_japanese/source/html/test.rst">翻訳コミット履歴</a> | <a href="https://github.com/codeigniter-jp/user_guide_src_ja/blob/develop_japanese/source/html/test.rst">GitHubで修正</a> ]</div>
        <hr/>
        <div>TODO write content</div>
    </body>
</html>

EOL;
        $this->assertEquals($expected, $test);
    }
}
