<?php
/**
 * Check FuelPHP Documentaion Translation
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2012 Kenji Suzuki
 * @link       https://github.com/kenjis/fuel-docs-tools
 */
namespace Kenjis\TranslationTools;

use SplHeap;
use RecursiveDirectoryIterator;
use FilesystemIterator;
use RecursiveIteratorIterator;

class SortedFileList extends SplHeap
{
    public function __construct($dir)
    {
        $rdi = new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS);
        $rii = new RecursiveIteratorIterator($rdi);

         foreach ($rii as $item) {
            $this->insert($item);
        }
    }

    public function compare($b, $a)
    {
        return strcmp($a->getRealpath(), $b->getRealpath());
    }
}
