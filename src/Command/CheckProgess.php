<?php

namespace Kenjis\TranslationTools\Command;

use Kenjis\TranslationTools\Document;
use Kenjis\TranslationTools\Calculator\TranslationRate;

class CheckProgess
{
    public function check(Document $docs_en, Document $docs_ja)
    {
        $rates = [];
        $calculator = new TranslationRate();

        foreach ($docs_en as $filePath => $file) {
            $lines_en = $docs_en->getFile($filePath)->getContaintArray();
            $lines_ja = $docs_ja->getFile($filePath)->getContaintArray();

            $rate = $calculator->calc($lines_en, $lines_ja);
            $rates[] = $rate;

            echo $file->getName(), "\t", sprintf("%d", $rate), PHP_EOL;
        }

        echo PHP_EOL, 'average: ', array_sum($rates) / count($rates), PHP_EOL;
    }
}
