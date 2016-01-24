<?php

namespace Kenjis\TranslationTools\Calculator;

class TranslationRate
{
    /**
     * @param array $lines_en
     * @param array $lines_ja
     */
    public function calc($lines_en, $lines_ja)
    {
        $sameLine = 0;
        $totalLine = 0;

        foreach ($lines_en as $lineNo => $line) {
            // Skip empty lines
            if ($this->isEmptyLine($lines_en[$lineNo], $lines_ja[$lineNo])) {
                continue;
            }
            // Skip double colon lines
            if ($this->isDoubleColon($lines_en[$lineNo], $lines_ja[$lineNo])) {
                continue;
            }
            // Skip title mark lines
            if ($this->isTitleMark($lines_en[$lineNo], $lines_ja[$lineNo])) {
                continue;
            }
            // Skip dot dot mark lines
            if ($this->isDotDot($lines_en[$lineNo], $lines_ja[$lineNo])) {
                continue;
            }
            // Skip source code without comments
            if (preg_match('/^\t/u', $lines_en[$lineNo])) {
                if (! preg_match('/\s\/\//u', $lines_en[$lineNo])) {
                    continue;
                }
            }

            if ($lines_en[$lineNo] === $lines_ja[$lineNo]) {
                //echo $lines_en[$lineNo];
                //echo $lines_ja[$lineNo];
                $sameLine++;
            }
            $totalLine++;
        }

        return (1 - ($sameLine / $totalLine)) * 100;
    }

    protected function isTitleMark($line_en, $line_ja)
    {
        if (preg_match('/^#+$/', $line_en) && preg_match('/^#+$/', $line_ja)) {
            return true;
        }
        if (preg_match('/^-+$/', $line_en) && preg_match('/^-+$/', $line_ja)) {
            return true;
        }
        if (preg_match('/^=+$/', $line_en) && preg_match('/^=+$/', $line_ja)) {
            return true;
        }
        
        return false;
    }

    protected function isDotDot($line_en, $line_ja)
    {
        if (preg_match('/^\.\. toctree::$/', $line_en) && preg_match('/^\.\. toctree::$/', $line_ja)) {
            return true;
        }
        if (preg_match('/^\.\. contents::$/', $line_en) && preg_match('/^\.\. contents::$/', $line_ja)) {
            return true;
        }
        if (preg_match('/^\.\. raw:: html$/', $line_en) && preg_match('/^\.\. raw:: html$/', $line_ja)) {
            return true;
        }
        if (preg_match('/^\.\. php:class:: /', $line_en) && preg_match('/^\.\. php:class:: /', $line_ja)) {
            return true;
        }
        
        return false;
    }

    protected function isEmptyLine($line_en, $line_ja)
    {
        if (trim($line_en) === '' && trim($line_ja) === '') {
            return true;
        }
        
        return false;
    }

    protected function isDoubleColon($line_en, $line_ja)
    {
        if (trim($line_en) === '::' && trim($line_ja) === '::') {
            return true;
        }
        
        return false;
    }
}
