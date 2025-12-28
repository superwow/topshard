<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

/**
 * Paths Configuration
 */
class Paths extends BaseConfig
{
    /**
     * ---------------------------------------------------------------
     * SYSTEM FOLDER NAME
     * ---------------------------------------------------------------
     *
     * This variable must contain the name of your "system" folder.
     */
    public string $systemDirectory = __DIR__ . '/../../vendor/codeigniter4/framework/system';

    /**
     * ---------------------------------------------------------------
     * APPLICATION FOLDER NAME
     * ---------------------------------------------------------------
     */
    public string $appDirectory = __DIR__ . '/../';

    /**
     * ---------------------------------------------------------------
     * WRITABLE DIRECTORY NAME
     * ---------------------------------------------------------------
     */
    public string $writableDirectory = __DIR__ . '/../../writable';

    /**
     * ---------------------------------------------------------------
     * TESTS DIRECTORY NAME
     * ---------------------------------------------------------------
     */
    public string $testsDirectory = __DIR__ . '/../../tests';

    /**
     * ---------------------------------------------------------------
     * VIEW DIRECTORY NAME
     * ---------------------------------------------------------------
     */
    public string $viewDirectory = __DIR__ . '/../../app/Views';
}
