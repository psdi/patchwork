<?php

namespace Library;

/**
 * Loosely based on Katzgrau's Logger class
 * https://github.com/katzgrau/KLogger/blob/master/src/Logger.php
 * but with a few minor changes
 */

class Logger
{
    /** @var string */
    protected $logFilePath;
    /** @var resource */
    protected $fileHandle;
    protected $options = [
        'extension' => '.txt',
        'dateFormat' => 'Y-m-d G:i:s',
        'prefix' => 'log_',
        'defaultPermissions' => 0777,
        'filename' => false,
    ];

    public function __construct($logDirectory, array $options = [])
    {
        $this->options = array_merge($this->options, $options);

        $logDirectory = rtrim($logDirectory, DIRECTORY_SEPARATOR);
        if (!file_exists($logDirectory)) {
            mkdir($logDirectory, $this->options['defaultPermissions'], true);
        }
        $this->setLogFilePath($logDirectory);
        if (file_exists($this->logFilePath) && !is_writeable($this->logFilePath)) {
            throw new \RuntimeException('The file could not be written to. Check that appropriate permissions have been set.');
        }
        $this->setFileHandle('a');
    }

    public function setLogFilePath($logDirectory)
    {
        if ($this->options['filename']) {
            if (strpos($this->options['filename'], '.log') !== false || strpos($this->options['filename'], '.txt')) {
                $this->logFilePath = $logDirectory . DIRECTORY_SEPARATOR . $this->options['filename'];
            } else {
                $this->logFilePath = $logDirectory . DIRECTORY_SEPARATOR . $this->options['filename'] . $this->options['extension'];
            }
        } else {
            $this->logFilePath = $logDirectory . DIRECTORY_SEPARATOR . $this->options['prefix'] . \date('Y-m-d') . $this->options['extension'];
        }
    }

    /**
     * @return string|null
     */
    public function getLogFilePath() : ?string
    {
        return $this->logFilePath ?? null;
    }

    public function setFileHandle($writeMode)
    {
        $this->fileHandle = fopen($this->logFilePath, $writeMode);
    }

    public function write($class = '', $method = '', $key = '', $message = '', $context = [])
    {
        $line = (new \DateTime())->format('Y-m-d H:i:s') . "\t$key\t$message\t";
        $line .= $class . '::' . $method . "\t { ";
        foreach ($context as $key => $value) {
            $line .= "$key: $value, ";
        }
        $line .= "}\n";
        fwrite($this->fileHandle, $line);
    }

    public function __destruct()
    {
        if ($this->fileHandle) {
            fclose($this->fileHandle);
        }
    }
}