<?php

namespace Logger\Formatters;

interface Formatter
{
    public function message(string $level, string $message): string;
}