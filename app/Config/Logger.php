<?php

namespace Config;

use CodeIgniter\Log\Handlers\FileHandler;
use CodeIgniter\Log\Logger as BaseLogger;

class Logger extends BaseLogger
{
    public array $threshold = [
        'default' => 4,
        'metrics' => 4,
    ];

    public array $handlers = [
        'default' => [
            'class'     => FileHandler::class,
            'handles'   => ['critical', 'alert', 'emergency', 'debug', 'error', 'info', 'notice', 'warning'],
            'path'      => WRITEPATH . 'logs/',
            'fileExtension' => 'log',
            'filePermissions' => 0644,
            'dateFormat' => 'Y-m-d H:i:s',
            'level' => 'debug',
        ],
        'metrics' => [
            'class'     => FileHandler::class,
            'handles'   => ['debug', 'info', 'notice', 'warning', 'error', 'critical', 'alert', 'emergency'],
            'path'      => WRITEPATH . 'logs/metrics/',
            'fileExtension' => 'log',
            'filePermissions' => 0644,
            'dateFormat' => 'Y-m-d H:i:s',
            'level' => 'debug',
        ],
    ];
}
