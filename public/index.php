<?php

declare(strict_types=1);

$startTime = microtime(true);

// Path to the front controller (this file)
define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);

require_once __DIR__ . '/../vendor/autoload.php';

$paths = new Config\Paths();

// Ensure the current directory is pointing to the front controller's directory
chdir(FCPATH);

// Load the framework bootstrap
$app = Config\Services::codeigniter();
$app->setContext('web');
$app->setPaths($paths);
$app->setStartTime($startTime);
$app->run();
