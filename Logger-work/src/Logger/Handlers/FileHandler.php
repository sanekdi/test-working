<?php

namespace Logger\Handler;

use Logger\Formatters\Formatter;
use Logger\Formatters\LineFormatter;

class FileHandler extends AbstractHandler
{
    private string $filename = '';

    private Formatter $formatter;

    public function __construct(array $options)
    {
        parent::__construct($options);

        $filename = $options['filename'] ?? '';
        $filename = trim($filename);

        $this->checkFilePath($filename);
        $this->filename = $filename;

        $formatter =  $options['formatter'] ?? new LineFormatter('%date%  [%level_code%]  [%level%]  %message%');

        if (!$formatter instanceof Formatter)
        {
            throw new \RuntimeException('Formatter must be instanceof Formatter.');
        }

        $this->formatter = $formatter;

    }

    public function log($level, string $message, array $context = []): void
    {
        if(!$this->isSaveLog($level))
        {
            return;
        }

        $content = $this->formatter->message($level, $message);

        $this->saveFile($content);

    }

    private function checkFilePath(string $filename): bool|\RuntimeException
    {
        if(!$filename)
        {
            throw new \RuntimeException('The file path could not be empty.');
        }

        if(!file_exists($filename))
        {
            $size = file_put_contents($filename, '');
            if($size === false)
            {
                throw new \RuntimeException('The file could not be create.');
            }

            unlink($filename);
        }

        return true;
    }

    private function saveFile($content): int|false
    {
        return file_put_contents($this->filename, $content. PHP_EOL, FILE_APPEND);
    }

}