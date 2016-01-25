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
        
        $this->expectOutputString('Added GitHub links: html/test.html'.PHP_EOL);
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
<div style="float:right;margin-left:5px;">[ <a href="https://github.com/codeigniter-jp/ci-ja/blob/develop/user_guide_ja_src/source/html/test.rst">旧版翻訳途中</a> | <a href="https://github.com/bcit-ci/CodeIgniter/commits/develop/user_guide_src/source/html/test.rst">原文履歴</a> | <a href="https://github.com/codeigniter-jp/user_guide_src_ja/commits/develop_japanese/source/html/test.rst">翻訳履歴</a> | <a href="https://github.com/codeigniter-jp/user_guide_src_ja/blob/develop_japanese/source/html/test.rst">GitHubで修正</a> ]</div><br /><div style="float:right;margin-left:5px;">[ <b class="highlighted">翻訳者募集中</b> → <a href="https://docs.google.com/spreadsheets/d/1ZWD5XqwH-Uo9X7MR644jbL6O8p5LxIngLT8M547H8wc/edit?pref=2&pli=1#gid=0">翻訳状況</a> ]</div>
        <hr/>
        <div>TODO write content</div>
    </body>
</html>

EOL;
        $this->assertEquals($expected, $test);
    }

    public function testAdd_do_not_add_when_already_added()
    {
        $html = new File(__DIR__ . '/../Fixture/html/test_added.html');
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
