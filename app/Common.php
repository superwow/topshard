<?php

use Config\Services;

if (! function_exists('view')) {
    function view(string $name, array $data = [], array $options = [])
    {
        return Services::renderer()->setData($data)->render($name, $options);
    }
}
