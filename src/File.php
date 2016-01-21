<?php
/**
 * This file is part of the Kenjis.TranslationTools
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Kenjis\TranslationTools;

use SplFileObject;

class File extends SplFileObject
{
    public function __construct(
        $filename,
        $open_mode = "r",
        $use_include_path = false,
        $context = null
    )
    {
        parent::__construct($filename, $open_mode, $use_include_path, $context);
    }

    public function getLineCount()
    {
        return count(file($this->getPathname()));
    }
}
