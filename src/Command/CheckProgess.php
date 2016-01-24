<?php

namespace Kenjis\TranslationTools\Command;

use Kenjis\TranslationTools\Document;
use Kenjis\TranslationTools\Calculator\TranslationRate;

class CheckProgess
{
    public function check(Document $docs_en, Document $docs_ja)
    {
        $translatedLines = 0;
        $totalLines = 0;
        $calculator = new TranslationRate();

        foreach ($docs_en as $filePath => $file) {
            $lines_en = $docs_en->getFile($filePath)->getContaintArray();
            $lines_ja = $docs_ja->getFile($filePath)->getContaintArray();

            list($rate, $translated, $total) = $calculator->calc($lines_en, $lines_ja);
            $translatedLines += $translated;
            $totalLines += $total;

            echo $file->getName(), "\t", sprintf("%d\t%d\t%d", $rate, $translated, $total), PHP_EOL;
        }

        $rate = ($translatedLines / $totalLines) * 100;
        echo 'Total:', "\t", sprintf("%f\t%d\t%d", $rate, $translatedLines, $totalLines), PHP_EOL;
    }
}
