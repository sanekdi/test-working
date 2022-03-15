<?php

use Logger\Logger;
use Logger\Handler\FileHandler;

require '../src/Logger/Formatters/Formatter.php';
require '../src/Logger/Formatters/LineFormatter.php';

require '../src/Logger/LogLevel.php';
require '../src/Logger/LoggerInterface.php';
require '../src/Logger/AbstractLogger.php';
require '../src/Logger/Handlers/AbstractHandler.php';
require '../src/Logger/Handlers/FileHandler.php';
require '../src/Logger/Handlers/FakeHandler.php';
require '../src/Logger/Handlers/SysLogHandler.php';

require '../src/Logger/Logger.php';

$logger = new Logger();

// All logs
$FileHandler = new FileHandler([
    'is_enabled' => true,
    'filename' => __DIR__ . '/application.log',
    'formatter' => new \Logger\Formatters\LineFormatter(
        '%date% [%level_code%]  [%level%]   %message%',
        'Y-m-d H:i:s'
    ),
]);

$logger->addHandler($FileHandler);

/**
 * Логер который все ошибки будет писать в файл application.error.log
 */
$logger->addHandler(
    new FileHandler(
        [
            'is_enabled' => true,
            'filename' => __DIR__ . '/application.error.log',
            'levels' => [
                \Logger\LogLevel::LEVEL_ERROR,
            ],
            'formatter' => new \Logger\Formatters\LineFormatter(
                '%date%  [%level_code%]  [%level%]  %message%',
                'Y-m-d H:i:s'
            ),
        ]
    )
);

/**
 * Логгер который все информационные логи будет писать в файл application.info.log
 */
$logger->addHandler(
    new FileHandler(
        [
            'is_enabled' => true,
            'filename' => __DIR__ . '/application.info.log',
            'levels' => [
                \Logger\LogLevel::LEVEL_INFO,
            ],
            'formatter' => new \Logger\Formatters\LineFormatter(
                '%date%  [%level_code%]  [%level%]  %message%',
                'Y-m-d H:i:s'
            ),
        ]
    )
);

/**
 * Логгер который все debug логи записывает в syslog
 *
 * @see http://php.net/manual/ru/function.syslog.php
 */
$logger->addHandler(
    new \Logger\Handler\SysLogHandler(
        [
            'is_enabled' => true,
            'levels' => [
                \Logger\LogLevel::LEVEL_DEBUG,
            ],
        ]
    )
);

/**
 * Логгер который ничего не делает
 */
$logger->addHandler(
    new \Logger\Handler\FakeHandler()
);

/**
 * Логирование
 */

$logger->log(\Logger\LogLevel::LEVEL_ERROR, 'Error message');
$logger->error('Error message');

$logger->log(\Logger\LogLevel::LEVEL_INFO, 'Info message');
$logger->info('Info message');

$logger->log(\Logger\LogLevel::LEVEL_DEBUG, 'Debug message');
$logger->debug('Debug message');

$logger->log(\Logger\LogLevel::LEVEL_NOTICE, 'Notice message');
$logger->notice('Notice message');


$FileHandler->log(\Logger\LogLevel::LEVEL_INFO, 'Info message from FileHandler');
$FileHandler->info('Info message from FileHandler');

$FileHandler->setIsEnabled(false);

$FileHandler->log(\Logger\LogLevel::LEVEL_INFO, 'Info message from FileHandler');
$FileHandler->info('Info message from FileHandler');

echo 'Logger worked finish!';