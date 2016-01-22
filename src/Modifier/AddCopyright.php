<?php

namespace Kenjis\TranslationTools\Modifier;

use Kenjis\TranslationTools\Document;
use Kenjis\TranslationTools\File;

class AddCopyright
{
    protected $targetLineRegExp;
    protected $copyright;

    public function __construct()
    {
        $this->targetLineRegExp = '!&copy; Copyright 2014 - 20\d\d, British Columbia Institute of Technology\.!u';
        $this->copyright = '<br />Japanese Translation: <a href="http://codeigniter.jp/">CodeIgniter Users Group in Japan</a>';
    }

    public function add(File $html)
    {
        $content = '';
        $check = false;

        $filename = preg_replace('/\.html\z/', '.rst', $html->getName());

        foreach ($html as $line) {
            if ($check) {
                if (! preg_match('/' . preg_quote($this->copyright, '/') . '/u', $line, $matches)) {
                    $line = rtrim($line) . $this->copyright . "\n";
                    echo 'Added Copyright link: ' . $html->getName() . PHP_EOL;
                }
                $check = false;
            }

            if (preg_match($this->targetLineRegExp, $line, $matches)) {
                $check = true;
            }

            $content .= $line;
        }

        return $content;
    }
}
