<?php

namespace Config;

use CodeIgniter\Config\View as BaseView;

class View extends BaseView
{
    public bool $saveData = true;

    public string $viewsPath = APPPATH . 'Views/';

    public ?string $parserPath = null;
}
