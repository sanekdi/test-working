<?php

namespace Logger\Handler;

use Logger\AbstractLogger;
use Logger\LogLevel;

abstract class AbstractHandler extends AbstractLogger
{
    protected bool $enabled = true;

    protected array $levels = [];

    public function __construct($options=[])
    {
        $is_enabled = $options['is_enabled'] ?? true;
        if($is_enabled !== true)
        {
            $is_enabled = false;
        }
        $this->setIsEnabled($is_enabled);

        $levels = $options['levels'] ?? [];
        if(!is_array($levels))
        {
            $levels = [];
        }

        $this->setLogLevels($levels);


    }

    public function setIsEnabled(bool $enabled): void
    {
        $this->enabled = $enabled;
    }

    protected function setLogLevels(array $levels = []): void
    {
        $log_levels = array_values(LogLevel::getConstants());

        if(!$levels)
        {
            $this->levels = $log_levels;
        }

        foreach ($levels as $level)
        {
            if(in_array($level,  $log_levels))
            {
                $this->levels[] = $level;
            }
        }
    }

    protected function isSaveLog(string $level): bool
    {
        if($this->enabled !== true)
        {
            return false;
        }

        if(!in_array($level, $this->levels))
        {
            return false;
        }

        return true;
    }
}