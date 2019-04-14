<?php

namespace Library;

/**
 * src: https://www.php-fig.org/psr/psr-4/examples/
 */
class Loader
{
    /**
     * Adds a base directory for a namespace prefix.
     * 
     * @return void
     */
    public function addNamespace() {}

    /**
     * Loads class name for a given class name
     */
    public function loadClass() {}

    /**
     * If a file exists, require it and return true.
     * 
     * @param string $file The requested file
     * @return bool True if file exists, otherwise false
     */
    public function requireFile($file)
    {
        if (file_exists($file)) {
            require $file;
            return true;
        }
        return false;
    }
}