<?php

namespace Kenjis\TranslationTools\Modifier;

use Kenjis\TranslationTools\Document;
use Kenjis\TranslationTools\File;

class AddGitHubLink
{
    protected $originUrl;
    protected $originBranch;
    protected $originPath;
    protected $translationUrl;
    protected $translationBranch;
    protected $translationPath;
    protected $targetLineRegExp;

    public function __construct()
    {
        //      Origin: https://github.com/bcit-ci/CodeIgniter/blob/develop/user_guide_src/source/index.rst
        // Translation: https://github.com/codeigniter-jp/user_guide_src_ja/blob/develop_japanese/source/index.rst
        $this->originUrl = 'https://github.com/bcit-ci/CodeIgniter';
        $this->originBranch = 'develop';
        $this->originPath = '/user_guide_src/source/';
        $this->translationUrl = 'https://github.com/codeigniter-jp/user_guide_src_ja';
        $this->translationBranch = 'develop_japanese';
        $this->translationPath = '/source/';
        $this->targetLineRegExp = '!<hr/>!u';
    }

    public function add(File $html)
    {
        $content = '';
        $done = false;

        $filename = preg_replace('/\.html\z/', '.rst', $html->getName());

        $prevLine = false;
        foreach ($html as $line) {
            if ($done === false && preg_match($this->targetLineRegExp, $line, $matches)) {
                $done = true;
                
                $link_en = '<a href="' . $this->originUrl . '/commits/' . $this->originBranch . $this->originPath . $filename;
                $link_en .= '">原文コミット履歴</a>';

                $link_ja = '<a href="' . $this->translationUrl . '/commits/' . $this->translationBranch . $this->translationPath . $filename;
                $link_ja .= '">翻訳コミット履歴</a>';

                $link_ja_edit = '<a href="' . $this->translationUrl . '/blob/' . $this->translationBranch . $this->translationPath . $filename;
                $link_ja_edit .= '">GitHubで修正</a>';

                if (! preg_match('/\[.+?\]/u', $prevLine, $matches)) {
                    $line = '<div style="float:right;margin-left:5px;">[ ' . $link_en . ' | ' . $link_ja . ' | ' . $link_ja_edit . ' ]</div>' . "\n" . $line;
                    echo 'Added GitHub links: ' . $html->getName() . PHP_EOL;
                }
            }

            $content .= $line;
            $prevLine = $line;
        }

        return $content;
    }
}
