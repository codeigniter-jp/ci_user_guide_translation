<?php

namespace Kenjis\TranslationTools\Command;

use Kenjis\TranslationTools\Document;

class CheckLineCount
{
    public function check(Document $docs_en, Document $docs_ja)
    {
        $error = false;
        $msg = '';

        foreach ($docs_en as $filePath => $file) {
            $line_en = $docs_en->getFile($filePath)->getLineCount();
            $line_ja = $docs_ja->getFile($filePath)->getLineCount();

            if ($line_en !== $line_ja) {
                echo $filePath, ' : en ', $line_en, ' ja ', $line_ja, PHP_EOL;
                $error = true;
            }
        }

        return $error;
    }
}
