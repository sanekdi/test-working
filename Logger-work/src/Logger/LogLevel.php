<?php

namespace Logger;


class LogLevel
{
    const LEVEL_EMERGENCY = 'emergency';
    const LEVEL_ALERT = 'alert';
    const LEVEL_CRITICAL = 'critical';
    const LEVEL_ERROR = 'error';
    const LEVEL_WARNING = 'warning';
    const LEVEL_NOTICE = 'notice';
    const LEVEL_INFO = 'info';
    const LEVEL_DEBUG = 'debug';

    private static array $level_code = [
        self::LEVEL_EMERGENCY => '008',
        self::LEVEL_ALERT => '007',
        self::LEVEL_CRITICAL => '006',
        self::LEVEL_ERROR => '001',
        self::LEVEL_WARNING => '005',
        self::LEVEL_NOTICE => '004',
        self::LEVEL_INFO => '002',
        self::LEVEL_DEBUG => '003',
    ];

    private static array $level_sys = [
        self::LEVEL_EMERGENCY => LOG_EMERG,
        self::LEVEL_ALERT => LOG_ALERT,
        self::LEVEL_CRITICAL => LOG_CRIT,
        self::LEVEL_ERROR => LOG_ERR,
        self::LEVEL_WARNING => LOG_WARNING,
        self::LEVEL_NOTICE => LOG_NOTICE,
        self::LEVEL_INFO => LOG_INFO,
        self::LEVEL_DEBUG => LOG_DEBUG,
    ];

    public static function levelCode($level): string
    {
        $code = self::$level_code[$level] ?? false;

        if(!$code)
        {
            throw new \InvalidArgumentException('Not Found Level Code.');
        }

        return $code;
    }

    public static function sysLevelCode($level): string
    {
        $code = self::$level_sys[$level] ?? false;

        if(!$code)
        {
            throw new \InvalidArgumentException('Not Found Level SysLog.');
        }

        return $code;
    }

    public static function getConstants()
    {
        $oClass = new \ReflectionClass(__CLASS__);
        return $oClass->getConstants();
    }
}