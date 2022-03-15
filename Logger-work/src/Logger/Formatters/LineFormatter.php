<?php

namespace Logger\Formatters;

use Logger\LogLevel;

class LineFormatter implements Formatter
{

    private string $template;
    private string $date_format;

    public function __construct(string $template, string $date_format = null)
    {
        $this->template = trim($template);
        $date_format = trim($date_format);
        if (!$date_format) {
            $date_format = 'Y-m-d H:i:s';
        }

        $this->date_format = $date_format;
    }

    public function message(string $level, string $message): string
    {
        return strtr($this->template, [
            '%date%' => (new \DateTimeImmutable())->format($this->date_format),
            '[%level_code%]' => LogLevel::levelCode($level),
            '[%level%]' => strtoupper($level),
            '%message%' => trim($message),
        ]);
    }
}