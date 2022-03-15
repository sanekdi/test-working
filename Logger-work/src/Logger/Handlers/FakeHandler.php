<?php

namespace Logger\Handler;


class FakeHandler extends AbstractHandler
{

    public function __construct(array $options = [])
    {
        parent::__construct($options);
    }

    public function log($level, string $message, array $context = []): void
    {
        if(!$this->isSaveLog($level))
        {
            return;
        }
    }
}