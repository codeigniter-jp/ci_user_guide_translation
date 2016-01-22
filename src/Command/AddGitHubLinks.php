<?php

namespace Kenjis\TranslationTools\Command;

use Kenjis\TranslationTools\Document;
use Kenjis\TranslationTools\Modifier\AddGitHubLink;
use \Kenjis\TranslationTools\Modifier\AddCopyright;

class AddGitHubLinks
{
    public function add(Document $html_ja)
    {
        $github = new AddGitHubLink();
        foreach ($html_ja as $filePath => $file) {
            $content = $github->add($file);
            file_put_contents($file->getPathname(), $content);
        }

        $copyright = new AddCopyright();
        foreach ($html_ja as $filePath => $file) {
            $content = $copyright->add($file);
            file_put_contents($file->getPathname(), $content);
        }
    }
}
