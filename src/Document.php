<?php
/**
 * This file is part of the Kenjis.TranslationTools
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Kenjis\TranslationTools;

use Iterator;

class Document implements Iterator
{
    private $dir;
    private $files = [];
    private $fileExtention = 'rst';

    public function __construct($dir)
    {
        $this->dir = $dir;
        
        $this->readDir();
    }

    public function getFile($name)
    {
        return $this->files[$name];
    }

    protected function readDir()
    {
        $filelist = new SortedFileList($this->dir);

        foreach ($filelist as $file) {
            if ($file->isDir()) {
                continue;
            }

            // Skip .git directory
            if (substr($file->getPath(), 0, strlen($this->dir) + 5) === $this->dir . '/.git') {
                continue;
            }

            if ($file->getExtension() == $this->fileExtention) {
                $len = strlen($this->dir);
                $name = substr($file, $len + 1);
                $this->files[$name] = new File($file);
            }
        }
    }

    public function current()
    {
        return current($this->files);
    }
    
    public function key()
    {
        return key($this->files);
    }
    
    public function next()
    {
        return next($this->files);
    }
    
    public function rewind()
    {
        return reset($this->files);
    }
    
    public function valid()
    {
        return (key($this->files) === null) ? false : true;
    }
}
