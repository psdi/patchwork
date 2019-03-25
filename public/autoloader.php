<?php

namespace Library;

class Autoloader
{
    /**
     * ".php" is the default file extension
     */
    protected static $fileExt = '.php';
    protected static $root = '';
    protected static $projectStructure = [];
    protected static $fileIterator = null;

    public static function loader($className = '')
    {
        if (!$className) {
            throw new \Exception('Somehow, no class was given.');
        }

        if (!static::$projectStructure) {
            throw new \Exception('thinga thang thang');
        }

        $nameParts = explode('\\', ltrim($className, '\\'));

        $count = count($nameParts);
        $filename = '';
        $currentDir = static::$projectStructure;
        for ($i = 0; $i < ($count - 1); $i++) {
            $namespace = $nameParts[$i];
            if (array_key_exists($namespace, $currentDir)) {
                $filename .= $currentDir[$namespace]['dir'];
                $currentDir = $currentDir[$namespace]['sub'];
            }
        }
        $filename .= $nameParts[$count - 1] . static::$fileExt;
        if (file_exists($filename)) {
            include $filename;
            return true;
        }
        return false;
    }

    public static function setRoot($root)
    {
        static::$root = $root;
    }

    public static function getRoot() : string
    {
        return static::$root;
    }

    public static function setNamespaceMap(array $struct)
    {
        static::$projectStructure = $struct;
    }
}