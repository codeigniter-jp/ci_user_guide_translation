<?php

namespace Kenjis\TranslationTools\Command;

use Kenjis\TranslationTools\Document;
use Kenjis\TranslationTools\Modifier\AddGitHubLink;

class AddGitHubLinks
{
    public function add(Document $html_ja)
    {
        $modifier = new AddGitHubLink();
        
        foreach ($html_ja as $filePath => $file) {
            $content = $modifier->add($file);
            file_put_contents($file->getPathname(), $content);
        }
    }
}
