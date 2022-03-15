<?php

namespace Logger;

abstract class AbstractLogger implements LoggerInterface
{
    public function emergency(string $message, array $context = []): void
    {
        $this->log(LogLevel::LEVEL_EMERGENCY, $message, $context);
    }

    public function alert(string $message, array $context = []): void
    {
        $this->log(LogLevel::LEVEL_ALERT, $message, $context);
    }


    public function critical(string $message, array $context = []): void
    {
        $this->log(LogLevel::LEVEL_CRITICAL, $message, $context);
    }


    public function error(string $message, array $context = []): void
    {
        $this->log(LogLevel::LEVEL_ERROR, $message, $context);
    }

    public function warning(string $message, array $context = []): void
    {
        $this->log(LogLevel::LEVEL_WARNING, $message, $context);
    }


    public function notice(string $message, array $context = []): void
    {
        $this->log(LogLevel::LEVEL_NOTICE, $message, $context);
    }


    public function info(string $message, array $context = []): void
    {
        $this->log(LogLevel::LEVEL_INFO, $message, $context);
    }


    public function debug(string $message, array $context = []): void
    {
        $this->log(LogLevel::LEVEL_DEBUG, $message, $context);
    }


    abstract public function log(string $level, string $message, array $context = []): void;
}