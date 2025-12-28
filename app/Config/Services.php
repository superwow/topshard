<?php

namespace Config;

use CodeIgniter\Config\BaseService;
use CodeIgniter\Router\RouteCollectionInterface;
use CodeIgniter\Router\Router;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\View\RendererInterface;

class Services extends BaseService
{
    public static function routes(bool $getShared = true): RouteCollectionInterface
    {
        if ($getShared) {
            return static::getSharedInstance('routes');
        }

        return new Router(Services::locator(), Services::logger());
    }

    public static function renderer(?string $viewPath = null, $config = null, bool $getShared = true): RendererInterface
    {
        return parent::renderer($viewPath, $config, $getShared);
    }

    public static function request(?RequestInterface $request = null, bool $getShared = true): RequestInterface
    {
        return parent::request($request, $getShared);
    }

    public static function response(?ResponseInterface $response = null, bool $getShared = true): ResponseInterface
    {
        return parent::response($response, $getShared);
    }
}
