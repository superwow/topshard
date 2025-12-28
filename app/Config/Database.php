<?php

namespace Config;

use CodeIgniter\Database\Config as DatabaseConfig;

class Database extends DatabaseConfig
{
    public array $default = [
        'DSN'      => '',
        'hostname' => 'localhost',
        'username' => 'root',
        'password' => '',
        'database' => 'topshard',
        'DBDriver' => 'MySQLi',
        'DBPrefix' => '',
        'charset'  => 'utf8mb4',
        'DBCollat' => 'utf8mb4_general_ci',
        'pConnect' => false,
        'DBDebug'  => (ENVIRONMENT !== 'production'),
        'cacheOn'  => false,
        'cacheDir' => '',
        'swapPre'  => '',
        'encrypt'  => false,
        'compress' => false,
        'strictOn' => false,
        'failover' => [],
        'port'     => 3306,
        'foreignKeys' => true,
        'busyTimeout' => 1000,
    ];

    public array $tests = [
        'DSN'      => '',
        'hostname' => 'localhost',
        'username' => 'root',
        'password' => '',
        'database' => 'topshard_test',
        'DBDriver' => 'MySQLi',
        'DBPrefix' => '',
        'charset'  => 'utf8mb4',
        'DBCollat' => 'utf8mb4_general_ci',
        'pConnect' => false,
        'DBDebug'  => true,
        'cacheOn'  => false,
        'cacheDir' => '',
        'swapPre'  => '',
        'encrypt'  => false,
        'compress' => false,
        'strictOn' => false,
        'failover' => [],
        'port'     => 3306,
        'foreignKeys' => true,
        'busyTimeout' => 1000,
    ];
}
