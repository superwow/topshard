<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class App extends BaseConfig
{
    public string $baseURL = 'http://localhost:8080/';

    public string $indexPage = '';

    public string $uriProtocol = 'REQUEST_URI';

    public string $defaultLocale = 'en';

    public array $supportedLocales = ['en', 'ru'];

    public bool $negotiateLocale = false;

    public string $appTimezone = 'UTC';

    public string $adminPassword = 'changeme';

    public string $charset = 'UTF-8';

    public bool $forceGlobalSecureRequests = false;

    public bool $sessionDriver = 'CodeIgniter\\Session\\Handlers\\FileHandler';

    public string $sessionCookieName = 'ci_session';

    public string $sessionSavePath = WRITEPATH . 'session';

    public int $sessionExpiration = 7200;

    public bool $sessionMatchIP = false;

    public int $sessionTimeToUpdate = 300;

    public bool $sessionRegenerateDestroy = false;

    public string $cookiePrefix = '';

    public bool $cookieSecure = false;

    public bool $cookieHTTPOnly = true;

    public string $cookieSameSite = 'Lax';

    public string $proxyIPs = '';

    public bool $CSPEnabled = false;

    public function __construct()
    {
        parent::__construct();

        $this->adminPassword = env('app.adminPassword', $this->adminPassword);
    }
}
