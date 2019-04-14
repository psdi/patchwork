<?php

namespace Library;

/**
 * src: https://www.php-fig.org/psr/psr-4/examples/
 */
class Loader
{
    /**
     * An associative array with elements in the following format:
     *   "namespace prefix" => [ array of base dirs ]
     * 
     * @var array
     */
    protected $prefixes = [];

    public function register()
    {
        spl_autoload_register([$this, 'loadClass']);
    }

    /**
     * Adds a base directory for a namespace prefix.
     * 
     * @param string $prefix The namespace prefix
     * @param string $baseDir The base directory for the namespace
     * @param string $prepend If true, prepend $baseDir to $this->prefixes[$prefix] 
     * stack instead of appending it; this way, it is searched (and compared) first
     * @return void
     */
    public function addNamespace($prefix, $baseDir, $prepend = false)
    {
        $prefix = trim($prefix, '\\') . '\\';
        $baseDir = rtrim($baseDir, DIRECTORY_SEPARATOR) . '/';
        if (!isset($this->prefixes[$prefix])) {
            $this->prefixes[$prefix] = [];
        }
        if ($prepend) {
            array_unshift($this->prefixes[$prefix], $baseDir);
        } else {
            $this->prefixes[$prefix][] = $baseDir;
        }
    }

    public function getPrefixes()
    {
        return $this->prefixes;
    }

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