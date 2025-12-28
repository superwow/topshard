<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Feature extends BaseConfig
{
    public bool $autoRoutesImproved = false;

    public bool $multipleFilters = true;

    public bool $jsonPrettyPrint = true;
}
