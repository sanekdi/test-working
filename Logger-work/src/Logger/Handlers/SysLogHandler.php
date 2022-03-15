<?php

namespace Logger\Handler;

use Logger\LogLevel;

class SysLogHandler extends AbstractHandler
{

    public function __construct(array $options)
    {
        parent::__construct($options);

    }

    public function log($level, string $message, array $context = []): void
    {
        if(!$this->isSaveLog($level))
        {
            return;
        }

        openlog('Logger::'.__CLASS__, LOG_PID | LOG_PERROR, 128);
        syslog(LogLevel::sysLevelCode($level), trim($message));
        closelog();
    }

}