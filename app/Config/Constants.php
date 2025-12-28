<?php

use Config\Paths;

if (! defined('APP_NAMESPACE')) {
    define('APP_NAMESPACE', 'App');
}

$paths = new Paths();

if (! defined('APPPATH')) {
    define('APPPATH', realpath($paths->appDirectory) . DIRECTORY_SEPARATOR);
}

if (! defined('ROOTPATH')) {
    define('ROOTPATH', realpath(APPPATH . '../') . DIRECTORY_SEPARATOR);
}

if (! defined('WRITEPATH')) {
    define('WRITEPATH', realpath($paths->writableDirectory) . DIRECTORY_SEPARATOR);
}

if (! defined('BASEPATH')) {
    define('BASEPATH', realpath($paths->systemDirectory) . DIRECTORY_SEPARATOR);
}

if (! defined('ENVIRONMENT')) {
    define('ENVIRONMENT', env('CI_ENVIRONMENT', 'production'));
}
